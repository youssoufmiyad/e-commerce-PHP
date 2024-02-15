<?php
// prise d'information sur la section actuelle
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>e-commerce PHP</title>
    <link rel="stylesheet" href="CSS/main.css" type="text/css">
</head>

<?php
// Mise à jour des produits
require_once('utils/generate_product_page.php'); ?>

<body>
    <!-- bouton de déconnexion (à mettre dans la navbar une fois faite) -->
    <form action="utils/disconnect.php">
        <input type="submit" name="disconnect" value="disconnect" />
    </form>

    <div class="title">
        <h1>E-commerce php</h1>
    </div>
    <?php
    // Test session
    if (@$_SESSION["user"]) {
        echo "<h1>Hello " . $_SESSION["user"]["firstName"] . "</h1>";
        echo bin2hex(random_bytes(16));
    }

    ?>

</body>

</html>

