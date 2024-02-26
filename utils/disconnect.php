<?php
// Fermeture de la session actuelle
session_start();
session_destroy();
header("location: http://localhost/e-commerce-PHP/index.php");