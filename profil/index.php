<!-- prise d'information sur la section actuelle -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Votre Profil - Prestige</title>
    <link rel="stylesheet" href="../CSS/profil.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <div class="container">
        <?php include("../navbar.php");
        $image = $db->query("SELECT Image FROM users_photo WHERE UserId=" . $_SESSION["user"]["userId"] . ";");
        $image = $image->fetch_assoc();
        $base64img = @base64_encode($image["Image"]);
        $src = "data:image/jpg;base64," . $base64img; ?>

        <div class="profile-container">
            <h1>Votre Profil</h1>
            <div class="profile-details">
                <!-- photo de profil -->
                <div class="profile-picture">
                    <img src="<?php if ($src !== "data:image/jpg;base64,") {
                        echo $src;
                    } else {
                        echo "./user-profile.png";
                    } ?>" alt="Photo de profil" />
                </div>
                <div class="profile-info">
                    <!-- prénom NOM -->
                    <p><strong>Nom:</strong>
                        <?php echo $_SESSION["user"]["lastName"] . " " . $_SESSION["user"]["firstName"] ?>
                    </p>
                    <p><strong>Email:</strong>
                        <?php echo $_SESSION["user"]["email"] ?>
                    </p>
                    <p><strong>Date d'inscription:</strong> 20 janvier 2024</p>
                    <p><strong>Dernière connexion:</strong> 5 février 2024</p>
                </div>
            </div>
            <div class="profile-actions">
                <form action="modify" id="modify"></form>
                <form action="../utils/disconnect.php" id="disconnect"></form>
                <button class="btn btn-primary" form="modify">Modifier le profil</button>
                <button class="btn btn-danger" form="disconnect">Déconnexion</button>
            </div>
            <br>
        </div>

        <div class="profile-info-container">
            <div>
                <h1>Adresses :</h1>
                <?php
                ?>
                <form action="adresses/add adress" method="get">
                    <input type="submit" class="btn btn-primary" value="Nouvelle adresse">
                </form>
                <br>
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
                                <form action="adresses/modify adress/index.php" method="GET" id="modify-adress">
                                    <input type="text" name="form-adress-id" id="form-adress-id"
                                        value="<?php echo $adresse['AdressId'] ?>" hidden>
                                    <input type="text" name="form-adress-country" value="<?= $adresse['Country'] ?>" hidden>
                                    <input type="text" name="form-adress-street" value="<?= $adresse['Street'] ?>" hidden>
                                    <input type="text" name="form-adress-city" value="<?= $adresse['City'] ?>" hidden>
                                    <input type="text" name="form-adress-postal-code" value="<?= $adresse['PostalCode'] ?>"
                                        hidden>

                                </form>
                                <form action="adresses/delete.php" method="post" id="delete-adress">
                                    <input type="text" name="adress-id" id="adress-id" value=<?php echo $adresse['AdressId'] ?>
                                        hidden>

                                </form>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Modify" form="modify-adress">
                                <input type="submit" class="btn btn-danger" value="Delete" form="delete-adress">


                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                    <br>
                    <?php
                }
                ?>
            </div>

            <div>
                <h1>Cartes :</h1>
                <?php
                ?>
                <form action="payment/add method" method="get">
                    <input type="submit" class="btn btn-primary" value="Nouvelle carte">
                </form>
                <br>
                <?php
                // Requête de selection du payment_method à la base de données
                $payment_methods = $db->query('SELECT * FROM payment WHERE UserId =' . $_SESSION["user"]["userId"]);
                if ($payment_methods->num_rows > 0) {
                    ?>
                    <div class="card-list">
                        <!-- affichage de chaque payment_method -->
                        <?php
                        foreach ($payment_methods as $payment_method) {
                            ?>
                            <div class="card-items" id="card-items">
                                <div class="card-type">
                                    <img src="../assets/<?= $payment_method['CardType'] ?>-card.svg" alt="Card type"
                                        width="32px" height="32px">
                                </div>
                                <div class="card-number">
                                    <?= substr($payment_method['CardNumber'], 0, 4) . "..." ?>
                                </div>
                                <div class="card-expiration">
                                    <?= $payment_method['ExpirationDate'] ?>
                                </div>
                                <br>
                                <form action="payment/delete.php" method="post">
                                    <input type="text" name="card-number" id="card-number" value=<?php echo $payment_method['CardNumber'] ?> hidden>
                                    <input type="submit" class="btn btn-danger" value="Delete">
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>