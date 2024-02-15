<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <?php
    // Requête de selection du produit à la base de données
    $produits = $db->query('SELECT * FROM products');
    if ($produits->num_rows > 0) {
        ?>
        <div class="product-list">
            <!-- affichage de chaque produit -->
            <?php
            foreach ($produits as $produit) {
                $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit["ProductId"] . ";");
                $image = $image->fetch_assoc();
                $base64img = @base64_encode($image["Image"]);
                $src = "data:image/jpeg;base64," . $base64img;
                ?>
                <div class="products-item" id="product-<?= $produit['ProductId'] ?>">
                    <div class="product-name">
                        <?= $produit['Name'] ?>
                    </div>
                    <div class="product-price">
                        <?= $produit['Price'] ?>€
                    </div>
                    <div class="product-image">
                        <img src="<?= $src ?>" alt="product image">
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

</body>

</html>