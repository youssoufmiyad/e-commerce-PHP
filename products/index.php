<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Boutique - Prestige</title>
    <link href="../CSS/products.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <?php require_once('../navbar.php'); ?>

    <div class="container">
        <main>
            <?php
            // Requête de selection du produit à la base de données
            $produits = $db->query('SELECT * FROM products');
            if ($produits->num_rows > 0) {
                ?>
                <!-- affichage de chaque produit -->
                <?php
                foreach ($produits as $produit) {

                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit["ProductId"] . ";");
                    $image = $image->fetch_assoc();
                    $base64img = @base64_encode($image["Image"]);
                    $src = "data:file/png;base64," . $base64img;
                    ?>
                    <div class="watch">
                        <img src="<?php echo $src ?>" alt="Rolex Pepsi" class="watch-image" />
                        <h2><a href="../product/<?= $produit['ProductId'] ?>">
                                <?= $produit['Name'] ?>
                            </a></h2>
                        <h6>
                            <?= $produit['Category'] ?>
                            </h3>
                            <p>
                                <?= $produit['Description'] ?>
                            </p>
                            <div class="price">
                                <?php if (strlen($produit['Price']) > 3) {
                                    echo substr_replace($produit['Price'], ",", -3, 0);
                                } else {
                                    echo $produit['Price'];
                                } ?> €
                            </div>
                            <form action="../product/add_to_cart.php" method="POST" id="add_to_cart">
                                <input type="text" name="product-id" value=<?= $produit['ProductId'] ?> hidden>
                                <input type="text" name="product-name" value=<?= $produit['Name'] ?> hidden>
                                <input type="number" name="cart-quantity" value="1" hidden>
                            </form>
                            <input type="submit" class="btn btn-primary" form="add_to_cart" value="Acheter" />

                            <br>
                    </div>

                    <?php
                }
                ?>
        </div>
        <?php
            }
            ?>
    </main>
    </div>
</body>

</html>