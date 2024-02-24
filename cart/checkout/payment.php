<?php
require_once("../../utils/connect.php");
session_start();

echo $_POST["adress-id"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/checkout.css">

    <title>payment</title>
</head>

<body>
    <div class="container-fluid">
        <div class="methods">
            <form id="form-card" method="POST" action="confirmation.php">
            <input type="hidden" name="adress-id" value="<?php echo $_POST["adress-id"] ?>">
                <?php
                // Requête de selection du method à la base de données
                $methods = $db->query('SELECT * FROM payment WHERE UserId =' . $_SESSION["user"]["userId"]);
                if ($methods->num_rows > 0) {
                    ?>
                    <div class="card-list">
                        <!-- affichage de chaque method -->
                        <?php
                        foreach ($methods as $method) {
                            ?>
                            <div class="card-items" id="card-items">
                                <input type="radio" name="card-id" value="<?= $method['CardNumber'] ?>">
                                <label class="">
                                    <div class="card-type">
                                        <img src="../../assets/<?= $method['CardType'] ?>-card.svg" alt="card type" width="64px"
                                            height="64px">
                                    </div>

                                    <div class="card-number">
                                        <?= substr($method['CardNumber'], 0, 4) . "..." ?>
                                    </div>

                                    <div class="card-expiration">
                                        <?= $method['ExpirationDate'] ?>
                                    </div>

                                </label>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                        <div class="card-items" id="card-items">
                            <input type="radio" name="card-id" value="new">
                            <label class="new-card">
                                Nouvelle carte <br>
                                <label for="form-card-number">Numéro de carte:</label><br>
                                <input type="text" id="form-card-number" name="form-card-number"><br>

                                <label for="form-card-expiration">Date d'expiration:</label><br>
                                <input type="month" id="form-card-expiration" name="form-card-expiration"><br>

                                <label for="form-card-cvv">CVV:</label><br>
                                <input type="text" id="form-card-cvv" name="form-card-cvv"><br><br>

                            </label>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </form>
        </div>
    </div>
    <button type="submit" form="form-card" class="shadow btn custom-btn">Suivant</button>
</body>

</html>