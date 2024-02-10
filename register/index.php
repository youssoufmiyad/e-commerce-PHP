<!DOCTYPE html>
<?php
require_once("../dashboard/connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['form-email']) && isset($_POST['form-password']) && isset($_POST['form-confirmPWD']) && isset($_POST['form-firstname']) && isset($_POST['form-lastname'])) {
        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];
        $pre_hash_pwd = $_POST['form-password'];
        $pre_hash_confirm_pwd = $_POST['form-confirmPWD'];
        $password = password_hash($pre_hash_pwd, PASSWORD_DEFAULT);

        $postQuery = $db->prepare("INSERT INTO `users` (`Lastname`, `Firstname`, `Email`, `Passwd`) VALUES (?,?,?,?);");
        $postQuery->bind_param("ssss", $lastname, $firstname, $email, $password);
        try {
            $postQuery->execute();
            echo "user inscris !";
        } catch (Exception $e) {
            throw $e;
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