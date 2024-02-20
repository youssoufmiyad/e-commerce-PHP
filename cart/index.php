<?php
// prise d'information sur la section actuelle
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include("../CSS/main.css") ?></style>
    <title>Cart</title>
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
<?php require_once('../navbar.php'); ?>
    <?php
    // Test si l'utilisateur est connecté
    if (@$_SESSION["user"]) {
        $products = $db->query('SELECT * FROM cart WHERE UserId=' . $_SESSION["user"]["userId"] . ';');
        // Test si l'utilisateur a ajouté des éléments au panier
        if ($products->num_rows > 0) {
            ?>
            <!-- Affichage de chaque produit -->
            <div class="product-list">
                <?php
                foreach ($products as $produit) {
                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit['ProductId'] . ";");
                    $image = $image->fetch_assoc();
                    $base64img = @base64_encode($image["Image"]);
                    $src = "data:image/jpeg;base64," . $base64img;
                    ?>
                    <div class="products-item" id="product-<?= $produit['ProductId'] ?>">
                        <div class="product-name">
                            <?= $produit['ProductName'] ?>
                        </div>
                        <div class="product-quantity">
                            <?= $produit['Quantity'] ?>
                        </div>
                        <div class="product-price">
                            <?= $produit['TotalPrice'] ?>€
                        </div>
                        <div class="product-image">
                            <img src="<?= $src ?>" alt="product image">
                        </div>
                    </div>
                    <br>
                    <?php
                }

        }else{
            echo "<h1>Votre panier est vide</h1>";
        }
        
    } else {
        echo "connectez vous pour voir votre panier";
    }
    ?>
</body>

</html>