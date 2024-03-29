<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once("../utils/connect.php");

// Regex du mot de passe, il doit contenir :
// - 1 caractère spécial
// - 1 lettre majuscule
// - 1 lettre minuscule
// - 1 chiffre
// - 8 caractère minimum

$PASSWORD_REGEXP = "^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8}$^";

// Envoi du formulaire de création d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (!empty($_POST['form-email']) && !empty($_POST['form-password']) && !empty($_POST['form-confirmPWD']) && !empty($_POST['form-firstname']) && !empty($_POST['form-lastname'])) {
        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];

        $password = password_hash($_POST['form-password'], PASSWORD_DEFAULT);
        $confirm_password = password_verify($_POST['form-confirmPWD'], $password);

        $mails = $db->query("SELECT Email from users");
        $mail_taken = false;

        foreach ($mails as $value) {

        }

        if ($mail_taken) {
            echo "Adresse mail déja enregistré sur un compte";
        }
        // Vérification de la validité de l'email
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        }
        // Vérification de la validité du mot de passe selon le regex
        else if (!filter_var($_POST['form-password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $PASSWORD_REGEXP)))) {
            echo "invalid password";
        }
        // Vérification de la correspondance entre le mot de passe et sa confirmation
        else if (!$confirm_password) {
            echo "Les mot de passe ne corresspondent pas";
        } else {
            // Requête d'insert de l'utilisateur à la base de données
            $postQuery = $db->prepare("INSERT INTO `users` (`Lastname`, `Firstname`, `Email`, `Passwd`) VALUES (?,?,?,?);");
            $postQuery->bind_param("ssss", $lastname, $firstname, $email, $password);
            try {
                $postQuery->execute();
                echo "user inscris !";
            } catch (Exception $e) {
                throw $e;
            }

            // attribution de la photo de profil par défaut
            try {
                $tmpFile = tempnam('./', 'TMP');
                $err = copy('./Default_pfp.jpg', $tmpFile);

                $image = file_get_contents($tmpFile);

                $actualUser = $db->query("SELECT * from users WHERE Email='$email'")->fetch_assoc();

                $addPhoto = $db->prepare("INSERT INTO `users_photo` (`UserId`, `Image`) VALUES (?,?);");
                $addPhoto->bind_param("ss", $actualUser["UserId"], $image);
                echo $actualUser["UserId"];
                $addPhoto->execute();
                echo "Photo ajouté avec succès !";
                unlink($tmpFile);
            } catch (\Throwable $th) {
                throw $th;
            }

            $to_email = "<" . $actualUser["Email"] . ">";
            $subject = "Simple Email Test via PHP";
            $body = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mail</title>
</head>

<body>
    <h1>Veuillez confirmer votre inscription</h1>

    <form action="http://localhost/e-commerce-PHP/confirm mail.php" method="post">
        <input type="hidden" name="user-id" id="user-id" value="' . $actualUser["UserId"] . '">
        <input type="submit" value="confirmer">
    </form>
</body>

</html>';
            $headers = "From: prestigewatch50@gmail.com";
            $headers .= "MIME-Version: 1.0" . "\r\nContent-type:text/html;charset=UTF-8" . "\r\n";

            if (mail($to_email, $subject, $body, $headers)) {
                echo "Email successfully sent to $to_email...";
                header("location: ../");
            } else {
                echo "Email sending failed...";
            }
        }
    } else {
        echo "incomplet";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include("../CSS/register.css") ?>
    </style>
    <title>register</title>
</head>

<body>
    <div class="container">
        <?php include("../navbar.php") ?>
        <script>
            const logo = document.getElementById("logo")
            logo.src = "../assets/img/Blue-Prestige.png"
        </script>
        <form method="post">
            <label for="form-lastname">Last name:</label><br>
            <input type="text" id="form-lastname" name="form-lastname"><br><br>
            <label for="form-firstname">First name:</label><br>
            <input type="text" id="form-firstname" name="form-firstname"><br>
            <label for="form-email">Email:</label><br>
            <input type="text" id="form-email" name="form-email"><br><br>
            <label for="form-password">Password:</label><br>
            <input type="password" id="form-password" name="form-password"><br><br>
            <label for="form-confirmPWD">Confirm password:</label><br>
            <input type="password" id="form-confirmPWD" name="form-confirmPWD"><br><br>
            <input type="submit" value="Submit">
        </form>
</body>

</html>