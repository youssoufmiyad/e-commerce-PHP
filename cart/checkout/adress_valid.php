<?php
require_once("../../utils/connect.php");
session_start();
if (empty($_POST["adress-id"])) {
    header("location: .");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST["adress-id"] !== "new") {
        ?>
        <form method="POST" action="payment.php" id="id-form">
            <input type="hidden" name="adress-id" value="<?php echo $_POST["adress-id"] ?>">
        </form>
        <script>
            function submit() {
                let form = document.getElementById("id-form");
                form.submit();
            }
            submit();
        </script>
        <?php
    } else
        if (!empty($_POST['form-adress-street']) && !empty($_POST['form-adress-city']) && !empty($_POST['form-adress-country']) && !empty($_POST['form-adress-postal-code'])) {

            $street = $_POST['form-adress-street'];
            $city = $_POST['form-adress-city'];
            $country = $_POST['form-adress-country'];
            $postal_code = ($_POST['form-adress-postal-code']);

            $addAdress = $db->prepare("INSERT INTO `adresses` (`UserId`, `Street`, `City`, `Country`, `PostalCode` ) VALUES (?,?,?,?,?);");
            $addAdress->bind_param("issss", $_SESSION["user"]["userId"], $street, $city, $country, $postal_code);
            $addAdress->execute();

            $id = $db->query("SELECT AdressId from adresses WHERE UserId=" . $_SESSION["user"]["userId"] . " AND Street='" . $street . "' AND Country='" . $country . "'");
            $id = $id->fetch_assoc();
            $id = $id["AdressId"];
            ?>
            <form method="POST" action="payment.php" id="id-form">
                <input type="hidden" name="adress-id" value="<?php echo $id ?>">
            </form>
            <script>
                function submit() {
                    let form = document.getElementById("id-form");
                    form.submit();
                }
                submit();
            </script>
            <?php

        } else {
            ?>
            <form method="POST" action="index.php" id="id-form">
                <input type="hidden" name="error" value="Champs manquant pour la nouvelle adresse">
            </form>
            <script>
                function submit() {
                    let form = document.getElementById("id-form");
                    form.submit();
                }
                submit();
            </script>
            <?php
        }
}