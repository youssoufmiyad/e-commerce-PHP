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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>