<?php
require_once("utils/connect.php");
echo "GET : ";
foreach ($_GET as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}

echo "POST : ";
foreach ($_POST as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["x_user-id"])) {
        $disabled_users = $db->query("SELECT * FROM users WHERE Enabled=0");
        if ($disabled_users->num_rows) {
            foreach ($disabled_users as $user) {
                if ($_GET["x_user-id"] === $user["UserId"]) {
                    $db->query("UPDATE users SET Enabled=1 WHERE UserId=" . $user["UserId"]);
                    echo "CONFIRMED";
                    break;
                }
            }
        }
    }else{
        echo "NO VALUE SET";
    }


}
?>