<?php session_start();
require_once("../../utils/connect.php")
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../../CSS/bootsrap.min.css">
    <link rel="stylesheet" href="../../CSS/checkout.css">
</head>

<body>
    <div class="container-fluid">
        <div class="adresses">
            <form id="form-adress" method="POST" action="adress_valid.php">
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
                                <input type="radio" name="adress-id" value="<?= $adresse['AdressId'] ?>">
                                <label class="">
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
                                </label>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                        <div class="adress-items" id="adress-items">
                            <input type="radio" name="adress-id" value="new">
                            <label class="new-adress">
                                Nouvelle adresse <br>
                                    <label for="form-adress-country">Pays:</label><br>
                                    <select name="form-adress-country" id="form-adress-country">
                                        <option value="DE">Allemagne</option>
                                        <option value="BE">Belgique</option>
                                        <option value="HR">Croatie</option>
                                        <option value="DK">Danemark</option>
                                        <option value="ES">Espagne</option>
                                        <option value="FR">France</option>
                                        <option value="GR">Greece</option>
                                        <option value="GB">Royaume Uni</option>
                                    </select><br>

                                    <label for="form-adress-street">Rue:</label><br>
                                    <input type="text" id="form-adress-street" name="form-adress-street"><br>

                                    <label for="form-adress-city">Ville:</label><br>
                                    <input type="text" id="form-adress-city" name="form-adress-city"><br>

                                    <label for="form-adress-postal-code">Code Postal:</label><br>
                                    <input type="text" id="form-adress-postal-code" name="form-adress-postal-code"><br><br>

                            </label>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </form>
        </div>
    </div>
    <button type="submit" form="form-adress" class="shadow btn custom-btn">Suivant</button>
</body>

</html>