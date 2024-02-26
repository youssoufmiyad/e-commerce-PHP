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
            "SELECT * FROM users WHERE Enabled=1"
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
    <link rel="stylesheet" href="../CSS/login.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <title>login</title>
</head>


<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <a href="../">
                    <img src="../assets/img/Violet-white-prestige.png" alt="Logo " class="logo" />
                </a>
                <div class="right-menu">
                    <a class="nav-link" href="/products/products.html">Shop</a>
                    <a class="nav-link" href="/about.html">À Propos</a>
                    <a class="nav-link" href="/contact.html">Nous contacter</a>
                    <a class="nav-link btn btn-dark text-white" href="../register/index.php">Inscription</a>
                </div>
            </nav>
        </header>
        <div class="login-container">
            <div class="login-form">
                <h1>Connexion</h1>
                <p>Découvrez l'élégance et le "Prestige" chez nous.</p>
                <form method="POST">
                    <label for="email"><img src="/assets/img/icon/user.png" alt="" /> Entrer votre
                        Mail</label>
                    <input type="email" id="email" name="form-email" required />
                    <label for="password"><img src="/assets/img/icon/password1.png" alt="" /> Mot de
                        passe</label>
                    <input type="password" id="password" name="form-password" required />
                    <button type="submit" class="btn-gradient">Connexion</button>
                </form>
                <div class="other-login">
                    <p><a class="login-bold">Login</a> with Others</p>
                    <button class="btn-gitea">
                        <img src="/assets/img/icon/icons8-tea-24.png" alt="" />
                        <a href="https://gitea.com/user/login">Connectez-vous avec Gitea</a>
                    </button>
                    <button class="btn-github">
                        <img src="/assets/img/icon/icons8-github-32.png" alt="" /><a href="https://github.com/login">
                            Connectez-vous avec Github</a>
                    </button>
                </div>
            </div>
            <div class="login-description">
                <p>
                    Connectez-vous pour explorer l'exclusivité. Avec "Prestige",
                    découvrez l'art de l'horlogerie de luxe, où chaque montre raconte
                    une histoire d'élégance intemporelle.
                </p>
                <div class="image-container">
                    <img src="../assets/img/Icon_prestige.png" alt="Description de l'image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>