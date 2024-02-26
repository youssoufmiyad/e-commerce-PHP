<?php
session_start();
require_once("../../utils/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ;
    try {
        $db->query("UPDATE adresses SET UserId=NULL WHERE UserId = " . $_SESSION["user"]["userId"] . " AND AdressId = " . $_POST["adress-id"]);
        header("location: ../");

    } catch (\Throwable $th) {
        throw $th;
    }
}