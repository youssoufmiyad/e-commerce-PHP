<?php
// prise d'information sur la section actuelle
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce PHP</title>
    <!-- import CSS -->
    <style>
        <?php include("CSS/main.css") ?>
    </style>
</head>

<?php
// Mise à jour des produits
require_once('utils/generate_product_page.php'); ?>
<script type="text/javascript">
    function colorSwitch() {
        var element = document.getElementById("landing-page");
        if (element.classList.value === "landing-page-green"){
            element.classList.replace("landing-page-green", "landing-page-grey")
        }else{
            element.classList.replace("landing-page-grey", "landing-page-green")
        }
    }
</script>
<body>
    <div class="landing-page-green" id="landing-page">
        <?php require_once('navbar.php'); ?>
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
        <button onclick="colorSwitch()">switch</button>

    </div>
</body>


</html>