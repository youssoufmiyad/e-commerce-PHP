<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create user</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../../utils/connect.php');
ini_set("post_max_size", "30M");
ini_set("upload_max_filesize", "30M");
ini_set("memory_limit", "20000M");
echo ini_get("upload_max_filesize");
?>
<?php
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
        $ROOT = ".";
        foreach ($_FILES as $file => $details) {   // Move each file from its temp directory to $ROOT
            echo "tmp : " . $details['tmp_name'];
            echo "\nname : " . $details['name'];
            $temp = $details['tmp_name'];
            $target = $details['name'];
            move_uploaded_file($temp, $ROOT . '/' . $target);
        }

        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];
        $password = password_hash($_POST['form-password'], PASSWORD_DEFAULT);
        $confirm_password = password_verify($_POST['form-confirmPWD'], $password);

        $image = file_get_contents($_FILES["user-image"]["name"]);
        $info = getimagesize($_FILES["user-image"]["name"]);
        $extension = image_type_to_extension($info[2]);


        // Vérification de la validité de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
            $postQuery = $db->prepare("INSERT INTO `users` (`Lastname`, `Firstname`, `Email`, `Passwd`, `Enabled`) VALUES (?,?,?,?,1);");
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

                $image = file_get_contents("Default_pfp.jpg");

                $actualUser = $db->query("SELECT * from users WHERE Email='$email'")->fetch_assoc();

                $addPhoto = $db->prepare("INSERT INTO `users_photo` (`UserId`, `Image`) VALUES (?,?);");
                $addPhoto->bind_param("ss", $actualUser["UserId"], $image);
                echo $actualUser["UserId"];
                $addPhoto->execute();
                unlink($_FILES["user-image"]["name"]);

            } catch (Exception $e) {
                throw $e;
            }
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}




?>

<body>
    <?php require_once('../../../navbar.php'); ?>
    <form method="post" enctype="multipart/form-data">
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

        <input type="hidden" name="MAX_FILE_SIZE" value="999999999999">
        <label for="user-image">Image</label>
        <input type="file" name="user-image" id="user-image" accept="image/png, image/gif, image/jpeg"><br>

        <button>Poster</button>
    </form>
</body>


</html>