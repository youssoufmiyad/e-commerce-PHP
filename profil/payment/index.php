<?php
session_start();
require_once("../../utils/connect.php")
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment payment_methods</title>
</head>

<body>
    <?php
    // Requête de selection du payment_method à la base de données
    $payment_methods = $db->query('SELECT * FROM payment WHERE UserId ='.$_SESSION["user"]["userId"]);
    if ($payment_methods->num_rows > 0) {
        ?>
        <div class="card-list">
            <!-- affichage de chaque payment_method -->
            <?php
            foreach ($payment_methods as $payment_method) {
                ?>
                <div class="card-items" id="card-items">
                    <div class="card-type">
                        <?= $payment_method['CardType'] ?>
                    </div>
                    <div class="card-number">
                        <?= substr($payment_method['CardNumber'],0,4) ."..." ?>
                    </div>
                    <div class="card-expiration">
                        <?= $payment_method['ExpirationDate'] ?>
                    </div>
                    <button type="button">Modify</button>
                    <form action="delete.php" method="post">
                        <input type="text" name="card-number" id="card-number" value=<?php echo $payment_method['CardNumber']?> hidden>
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