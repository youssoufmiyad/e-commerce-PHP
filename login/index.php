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

                } else {
                    echo "<div class=\"login-error\">adresse mail ou mot de passe incorrect</div>";
                }
            }
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>


<body>
    <div>
        <form method="post">
            <label for="form-email">Email:</label><br>
            <input type="text" id="form-email" name="form-email"><br>

            <label for="form-password">Password:</label><br>
            <input type="password" id="form-password" name="form-password"><br>

            <button>submit</button>
        </form>
    </div>

</body>

</html>