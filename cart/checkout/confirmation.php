<?php
require_once("../../utils/connect.php");
session_start();

$adressId = $_POST["adress-id"];

$card_info = $db->query("SELECT * from payment WHERE CardNumber=" . $_POST["card-id"])->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo $_POST["card-id"];
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
            echo "numéro de carte invalide";
        } elseif (strlen($card_cvv) > 4) {
            echo "cvv invalide";
        } else {
            if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $MASTERCARD_REGEX)))) {
                $card_type = "Mastercard";
            } else if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $AMERICAN_EXPRESS_REGEX)))) {
                $card_type = "American Express";
            } else if (filter_var($card_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $VISA_REGEX)))) {
                $card_type = "VISA";
            } else {
                echo "card not supported";
                return;
            }
            if ($card_type) {
                $addCard = $db->prepare("INSERT INTO `payment` (`UserId`, `CardType`, `CardNumber`, `ExpirationDate`, `CVV` ) VALUES (?,?,?,?,?);");
                $addCard->bind_param("issss", $_SESSION["user"]["userId"], $card_type, $card_number, $card_date, $card_cvv);
                $addCard->execute();
                echo "card added";
            }


        }


        ?>

        <?php

    } else {
        echo "incomplet";
        $stmt = $db->prepare("INSERT INTO orders (AdressId, UserId) VALUES (?,?)");
        $stmt->bind_param("ii", $adressId, $_SESSION["user"]["userId"]);
        $stmt->execute();
        echo "order created";
    }
}