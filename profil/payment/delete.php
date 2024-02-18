<?php
session_start();
require_once("../../utils/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db->query("DELETE FROM payment WHERE UserId = ".$_SESSION["user"]["userId"]." AND CardNumber = ".$_POST["card-number"]);
    header("location: ../");
}