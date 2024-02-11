<!DOCTYPE html>
<?php
require_once("../dashboard/connect.php");

$PASSWORD_REGEXP = "^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8}$^";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['form-email']) && !empty($_POST['form-password']) && !empty($_POST['form-confirmPWD']) && !empty($_POST['form-firstname']) && !empty($_POST['form-lastname'])) {
        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];
        $password = password_hash($_POST['form-password'], PASSWORD_DEFAULT);
        $confirm_password = password_verify($_POST['form-confirmPWD'], $password);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else if (!filter_var($_POST['form-password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $PASSWORD_REGEXP)))) {
            echo "invalid password";
        } else if (!$confirm_password) {
            echo "Les mot de passe ne corresspondent pas";
        } else {
            $postQuery = $db->prepare("INSERT INTO `users` (`Lastname`, `Firstname`, `Email`, `Passwd`) VALUES (?,?,?,?);");
            $postQuery->bind_param("ssss", $lastname, $firstname, $email, $password);
            try {
                $postQuery->execute();
                echo "user inscris !";
            } catch (Exception $e) {
                throw $e;
            }
        }

    } else {
        echo "incomplet";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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