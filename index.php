<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>e-commerce PHP</title>
    <link rel="stylesheet" href="CSS/main.css" type="text/css">
</head>

<?php
require_once('./generate_product_page.php'); ?>

<body>
    <form action=<?php session_destroy(); ?>>
        <input type="submit" name="disconnect" value="disconnect" />
    </form>

    <div class="title">
        <h1>E-commerce php</h1>
    </div>
    <?php
    if (@$_SESSION["user"]) {
        echo "<h1>Hello " . $_SESSION["user"]["firstName"] . "</h1>";
    }

    ?>

</body>

</html>

<?php
