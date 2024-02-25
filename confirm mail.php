<?php
require_once("utils/connect.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $disabled_users = $db->query("SELECT * FROM users WHERE Enabled=0");
    if ($disabled_users->num_rows) {
        foreach ($disabled_users as $user) {
            if ($_POST["user-id"] === $user["UserId"]) {
                $db->query("UPDATE users SET Enabled=1 WHERE UserId=" . $user["UserId"]);
                echo "CONFIRMED";
                break;
            }
        }
    }

}
?>