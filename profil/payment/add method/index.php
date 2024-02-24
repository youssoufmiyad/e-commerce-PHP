<?php
require_once("../../../utils/connect.php");

session_start();

$VISA_REGEX = "^4[0-9]{12}(?:[0-9]{3})?$^";
$MASTERCARD_REGEX = "^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$^";
$AMERICAN_EXPRESS_REGEX = "^3[47][0-9]{13}$^";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['form-card-number']) && !empty($_POST['form-card-expiration-date']) && !empty($_POST['form-card-cvv'])) {

        $card_number = str_replace(" ", "", $_POST['form-card-number']);
        $card_date = str_replace("-", "/", $_POST['form-card-expiration-date']);
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

    } else {
        echo "incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include("../../../CSS/main.css") ?>
    </style>
    <title>Add payment method</title>
</head>

<body>
    <?php require_once('../../../navbar.php'); ?>
    <form method="post">
        <label for="form-card-number">Card number:</label><br>
        <input type="text" id="form-card-number" name="form-card-number"><br>
        <label for="form-card-expiration-date">Expiration date:</label><br>
        <input type="month" id="form-card-expiration-date" name="form-card-expiration-date"><br>
        <label for="form-card-cvv">CVV:</label><br>
        <input type="text" id="form-card-cvv" name="form-card-cvv"><br><br>
        <input type="submit">
    </form>
</body>

</html>