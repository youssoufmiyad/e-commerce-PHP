<?php
require_once("../../utils/connect.php");
session_start();

$adressId = $_POST["adress-id"];

$card_info = $db->query("SELECT * from payment WHERE CardNumber=" . $_POST["card-id"])->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST["card-id"] !== "new") {
        ?>
        <form method="POST" action="payment.php" id="id-form">
            <input type="hidden" name="card-id" value="<?php echo $_POST["card-id"] ?>">
        </form>
        <script>
            function submit() {
                let form = document.getElementById("id-form");
                form.submit();
            }
            // submit();
        </script>
        <?php
    }
    if (!empty($_POST['form-card-number']) && !empty($_POST['form-card-expiration']) && !empty($_POST['form-card-cvv'])) {
        $VISA_REGEX = "^4[0-9]{12}(?:[0-9]{3})?$^";
        $MASTERCARD_REGEX = "^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$^";
        $AMERICAN_EXPRESS_REGEX = "^3[47][0-9]{13}$^";

        $card_number = str_replace(" ", "", $_POST['form-card-number']);
        $card_date = str_replace("-", "/", $_POST['form-card-expiration']);
        $card_cvv = $_POST['form-card-cvv'];

        if (strlen($card_number) < 15 || strlen($card_number) > 16) {
            throw new Exception("numéro de carte invalide");
        } elseif (strlen($card_cvv) > 4) {
            throw new Exception("cvv invalide", 1);
        } else {
            if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $MASTERCARD_REGEX)))) {
                $card_type = "Mastercard";
            } else if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $AMERICAN_EXPRESS_REGEX)))) {
                $card_type = "American Express";
            } else if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $VISA_REGEX)))) {
                $card_type = "VISA";
            } else {
                throw new Exception("card not supported", 1);
            }
            if ($card_type) {
                $addCard = $db->prepare("INSERT INTO `payment` (`UserId`, `CardType`, `CardNumber`, `ExpirationDate`, `CVV` ) VALUES (?,?,?,?,?);");
                $addCard->bind_param("issss", $_SESSION["user"]["userId"], $card_type, $card_number, $card_date, $card_cvv);
                $addCard->execute();
            }


        }


        ?>

        <?php

    }
    $stmt = $db->prepare("INSERT INTO orders (AdressId, UserId) VALUES (?,?)");
    $stmt->bind_param("ii", $adressId, $_SESSION["user"]["userId"]);
    $stmt->execute();

    $orderId = $stmt->insert_id;
    $order = $db->query('SELECT * FROM orders WHERE OrderId=' . $orderId . ';')->fetch_assoc();

    $cartId = $db->query('SELECT * FROM cart WHERE UserId=' . $_SESSION["user"]["userId"] . ';')->fetch_assoc();
    $products = $db->query('SELECT * FROM cart_items WHERE cartId=' . $cartId["CartId"] . ';');

    $totalPrice = $cartId["TotalPrice"];


    foreach ($products as $product) {
        $addItems = $db->prepare("INSERT INTO order_items (OrderId, Price, ProductId, Quantity) VALUES (?,?,?,?);");
        $addItems->bind_param("idii", $orderId, $product["Price"], $product["ProductId"], $product["Quantity"]);
        $addItems->execute();
    }
    $db->query("UPDATE orders SET TotalPrice=$totalPrice WHERE OrderId=$orderId");

    $db->query("UPDATE cart SET TotalPrice=0 WHERE UserId=" . $_SESSION["user"]["userId"] . ";");

    $db->query("DELETE FROM cart_items WHERE CartId = " . $cartId["CartId"]);

    $date = date('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO invoices (OrderId, UserId, InvoiceDate) VALUES (?,?,?)");
    $stmt->bind_param("iis", $orderId, $_SESSION["user"]["userId"], $date);
    $stmt->execute();
    ?>
    <?php require_once('../../navbar.php'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../CSS/checkout.css">
        <link rel="stylesheet" href="../../CSS/style.css">
    </head>

    <body>

    </body>

    </html>
    <div class="confirmation-container">
        <h1>Votre achat a bien été effectué</h1>

        <form action="invoice/index.php" method="POST">
            <input type="hidden" name="order-id" value="<?php echo $orderId ?>">
            <input type="submit" class="invoice-btn" value="Voir la facture">
        </form>
    </div>
    <?php
}