<?php
session_start();
require_once("../../utils/connect.php")
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include("../../CSS/main.css") ?></style>
    <title>adresses</title>
</head>

<body>
    <?php require_once('../../navbar.php'); ?>
    <?php
    // Requête de selection du adresse à la base de données
    $adresses = $db->query('SELECT * FROM adresses WHERE UserId =' . $_SESSION["user"]["userId"]);
    if ($adresses->num_rows > 0) {
        ?>
        <div class="adress-list">
            <!-- affichage de chaque adresse -->
            <?php
            foreach ($adresses as $adresse) {
                ?>
                <div class="adress-items" id="adress-items">
                    <div class="adress-country">
                        <img src="https://flagsapi.com/<?= $adresse['Country'] ?>/flat/64.png" alt="">
                    </div>
                    <div class="adress-street">
                        <?= $adresse['Street'] ?>
                    </div>
                    <div class="adress-city">
                        <?= $adresse['City'] ?>
                    </div>
                    <div class="adress-postal-code">
                        <?= $adresse['PostalCode'] ?>
                    </div>
                    <form action="modify adress" method="GET">
                        <input type="text" name="form-adress-id" id="form-adress-id" value="<?php echo $adresse['AdressId'] ?>"
                            hidden>
                        <input type="text" name="form-adress-country" value="<?= $adresse['Country'] ?>" hidden>
                        <input type="text" name="form-adress-street" value="<?= $adresse['Street'] ?>" hidden>
                        <input type="text" name="form-adress-city" value="<?= $adresse['City'] ?>" hidden>
                        <input type="text" name="form-adress-postal-code" value="<?= $adresse['PostalCode'] ?>" hidden>
                        <input type="submit" value="Modify">
                    </form>
                    <form action="delete.php" method="post">
                        <input type="text" name="adress-id" id="adress-id" value=<?php echo $adresse['AdressId'] ?> hidden>
                        <input type="submit" value="Delete">
                    </form>


                </div>
                <br>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</body>

</html>