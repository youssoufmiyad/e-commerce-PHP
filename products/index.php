<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <style>
        <?php include("../CSS/main.css") ?>
        <?php include("../CSS/products.css") ?>
        <?php include("../CSS/bootstrap.min.css") ?>
    </style>
</head>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <?php require_once('../navbar.php'); ?>

    <div class="container-fluid">
        <?php
        // Requête de selection du produit à la base de données
        $produits = $db->query('SELECT * FROM products');
        if ($produits->num_rows > 0) {
            ?>
            <div class="product-list row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
                <!-- affichage de chaque produit -->
                <?php
                foreach ($produits as $produit) {
                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit["ProductId"] . ";");
                    $image = $image->fetch_assoc();
                    $base64img = @base64_encode($image["Image"]);
                    $src = "data:image/jpeg;base64," . $base64img;
                    ?>
                    <div class="product-card col-mb-1">
                        <div class="product-tumb">
                            <img src="<?= $src ?>" alt="product image">
                        </div>
                        <div class="product-details">
                            <span class="product-catagory">
                                <?php if ($produit['Vendor'] !== "NULL") {
                                    echo $produit['Vendor'];
                                }elseif ($produit['UserId'] !== "NULL"){
                                    echo $produit['UserId'];
                                }else{
                                    echo "error";
                                } ?>
                            </span>
                            <h4><a href="../product/<?= $produit['ProductId'] ?>">
                                    <?= $produit['Name'] ?>
                                </a></h4>
                            <p>
                                <?= $produit['Description'] ?>
                            </p>
                            <div class="product-bottom-details">
                                <div class="product-price">
                                    <?= $produit['Price'] ?>€
                                </div>
                                <div class="product-links">
                                    <a href=""><img src="../assets/empty-heart-icon.png" alt="heart" width="64px"
                                            height="64px"></a>
                                    <a href=""><img src="../assets/cart-icon.png" alt="cart" width="64px" height="64px"></a>
                                </div>
                            </div>
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
    </div>
</body>

</html>