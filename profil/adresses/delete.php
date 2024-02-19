<?php
session_start();
require_once("../../utils/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db->query("DELETE FROM adresses WHERE UserId = ".$_SESSION["user"]["userId"]." AND AdressId = ".$_POST["adress-id"]);
    header("location: ../");
}