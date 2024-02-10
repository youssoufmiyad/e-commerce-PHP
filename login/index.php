<!DOCTYPE html>
<?php
require_once("../dashboard/connect.php");
?>
<?php
$return = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $users = $db->query(
            "SELECT * FROM users"
        );
    } catch (Exception $e) {
        throw $e;
    }

    if (isset($_POST['form-email']) && isset($_POST['form-password'])) {
        $email = $_POST['form-email'];
        $pre_hash_pwd = $_POST['form-password'];
        $password = password_hash($pre_hash_pwd, PASSWORD_DEFAULT);

        if ($users->num_rows > 0) {
            // output data of each row
            while ($row = $users->fetch_assoc()) {
                if ($row["Email"] === $email & $row["Passwd"] === $password) {
                    session_start();
                    $_SESSION["user"] = array(
                        "userId" => $row["UserId"],
                        "lastName" => $row["LastName"],
                        "firstName" => $row["FirstName"],
                        "email" => $row["Email"],
                        "password" => $row["Passwd"]
                    );
                    setcookie("user", $_SESSION["user"], time() + (86400 * 30), "/");
                    header("location: ./");
                } else {
                    echo "<div class=\"login-error\">adresse mail ou mot de passe incorrect</div>";
                }

            }
        } else {
            $return = "empty";
        }

    }
}
echo "return : $return"
    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <div>
        <form method="post">
            <label for="form-email">Email:</label><br>
            <input type="text" id="form-email" name="form-email"><br>

            <label for="form-password">Password:</label><br>
            <input type="password" id="form-confirmPWD" name="form-confirmPWD"><br>

            <button>submit</button>
        </form>
    </div>

</body>

</html>