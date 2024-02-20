<!-- prise d'information sur la section actuelle -->
<?php session_start(); ?>

<!DOCTYPE html>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once("../utils/connect.php");

// Envoi du formulaire de connection
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        // Requête de sélection des utilisateurs à des fins d'identification
        $users = $db->query(
            "SELECT * FROM users"
        );
    } catch (Exception $e) {
        throw $e;
    }

    // Vérification du remplissage des champs coté serveur
    if (isset($_POST['form-email']) && isset($_POST['form-password'])) {
        $email = $_POST['form-email'];
        $password = $_POST['form-password'];

        if ($users->num_rows > 0) {
            while ($row = $users->fetch_assoc()) {
                // Authentification
                if ($row["Email"] === $email & password_verify($password, $row["Passwd"])) {
                    try {

                        $_SESSION["user"] = array(
                            "userId" => $row["UserId"],
                            "lastName" => $row["LastName"],
                            "firstName" => $row["FirstName"],
                            "email" => $row["Email"],
                            "password" => $row["Passwd"]
                        );
                        setcookie("userId", $_SESSION["user"]["userId"], time() + (86400 * 30), "/");
                        header("location: ../");
                    } catch (Exception $th) {
                        throw $th;
                    }

                }
            }
            echo "<div class=\"login-error\">adresse mail ou mot de passe incorrect</div>";
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include("../CSS/main.css") ?>
    </style>
    <title>login</title>
</head>


<body>
    <?php require_once('../navbar.php'); ?>
    <div class="login-form-container">

        <div class="login-form">
            <span class="form-title">CONNEXION</span><br><br>
            <span class="form-subtitle">Découvrez l'élégance et le "Prestige" chez nous.</span><br><br>
            <form method="post">
                <input type="text" class="form-email" id="form-email" name="form-email"
                    placeholder="Entrez votre mail"><br><br>

                <input type="password" class="form-password" id="form-password" name="form-password"
                    placeholder="Mot de passe"><br><br>

                <button class="form-button">Connexion</button>
            </form>
        </div>
    </div>

</body>

</html>