<?php
require_once("../../../utils/connect.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['form-adress-street']) && !empty($_POST['form-adress-city']) && !empty($_POST['form-adress-country']) && !empty($_POST['form-adress-postal-code'])) {
        $id = $_GET['form-adress-id'];
        $street = $_POST['form-adress-street'];
        $city = $_POST['form-adress-city'];
        $country = $_POST['form-adress-country'];
        $postal_code = ($_POST['form-adress-postal-code']);

        $addAdress = $db->prepare("UPDATE `adresses` SET `Street`=?, `City`=?, `Country`=?, `PostalCode`=? WHERE `UserId`=? AND `AdressId`=? ;");
        $addAdress->bind_param("ssssii", $street, $city, $country, $postal_code, $_SESSION["user"]["userId"], $id);
        $addAdress->execute();
        header("location: ../");

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
            <option value="DE" <?php if ($_GET["form-adress-country"] === "DE")
                echo "selected" ?>>Allemagne</option>
                <option value="BE" <?php if ($_GET["form-adress-country"] === "BE")
                echo "selected" ?>>Belgique</option>
                <option value="HR" <?php if ($_GET["form-adress-country"] === "HR")
                echo "selected" ?>>Croatie</option>
                <option value="DK" <?php if ($_GET["form-adress-country"] === "DK")
                echo "selected" ?>>Danemark</option>
                <option value="ES" <?php if ($_GET["form-adress-country"] === "ES")
                echo "selected" ?>>Espagne</option>
                <option value="FR" <?php if ($_GET["form-adress-country"] === "FR")
                echo "selected" ?>>France</option>
                <option value="GR" <?php if ($_GET["form-adress-country"] === "GR")
                echo "selected" ?>>Greece</option>
                <option value="UK" <?php if ($_GET["form-adress-country"] === "UK")
                echo "selected" ?>>Royaume Uni</option>
            </select><br>

            <label for="form-adress-street">Rue:</label><br>
            <input type="text" id="form-adress-street" name="form-adress-street"
                value="<?php echo $_GET["form-adress-street"] ?>"><br>

        <label for="form-adress-city">Ville:</label><br>
        <input type="text" id="form-adress-city" name="form-adress-city"
            value="<?php echo $_GET["form-adress-city"] ?>"><br>

        <label for="form-adress-postal-code">Code Postal:</label><br>
        <input type="text" id="form-adress-postal-code" name="form-adress-postal-code"
            value="<?php echo $_GET["form-adress-postal-code"] ?>"><br><br>

        <input type="submit">
    </form>
</body>

</html>