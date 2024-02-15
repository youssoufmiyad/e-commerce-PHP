<?php
// Ouverture de la connection à la base de données
$db = mysqli_connect("localhost", "root", "", "e-commerce")
    or die("Impossible de se connecter : " . mysqli_error($db));
