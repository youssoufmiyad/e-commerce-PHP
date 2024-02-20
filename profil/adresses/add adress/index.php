<?php
require_once("../../../utils/connect.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['form-adress-street']) && !empty($_POST['form-adress-city']) && !empty($_POST['form-adress-country']) && !empty($_POST['form-adress-postal-code'])) {

        $street = $_POST['form-adress-street'];
        $city = $_POST['form-adress-city'];
        $country = $_POST['form-adress-country'];
        $postal_code = ($_POST['form-adress-postal-code']);

        $addAdress = $db->prepare("INSERT INTO `adresses` (`UserId`, `Street`, `City`, `Country`, `PostalCode` ) VALUES (?,?,?,?,?);");
        $addAdress->bind_param("issss", $_SESSION["user"]["userId"], $street, $city, $country, $postal_code);
        $addAdress->execute();
        echo "adress added";

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
    <style><?php include("../../../CSS/main.css") ?></style>
    <title>Add payment method</title>
</head>

<body>
    <?php require_once('../../../navbar.php'); ?>
    <form method="post">
        <label for="form-adress-country">Pays:</label><br>
        <select name="form-adress-country" id="form-adress-country">
            <option value="DE">Allemagne</option>
            <option value="BE">Belgique</option>
            <option value="HR">Croatie</option>
            <option value="DK">Danemark</option>
            <option value="ES">Espagne</option>
            <option value="FR">France</option>
            <option value="GR">Greece</option>
            <option value="UK">Royaume Uni</option>
        </select><br>

        <label for="form-adress-street">Rue:</label><br>
        <input type="text" id="form-adress-street" name="form-adress-street"><br>

        <label for="form-adress-city">Ville:</label><br>
        <input type="text" id="form-adress-city" name="form-adress-city"><br>

        <label for="form-adress-postal-code">Code Postal:</label><br>
        <input type="text" id="form-adress-postal-code" name="form-adress-postal-code"><br><br>

        <input type="submit">
    </form>
</body>

</html>