<?php
// prise d'information sur la section actuelle
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include("../CSS/main.css") ?>
    </style>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cart.css">
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
        $cartId = $db->query('SELECT * FROM cart WHERE UserId=' . $_SESSION["user"]["userId"] . ';')->fetch_assoc();
        $products = $db->query('SELECT * FROM cart_items WHERE cartId=' . $cartId["CartId"] . ';');
        // Test si l'utilisateur a ajouté des éléments au panier
        if ($products->num_rows > 0) {
            ?>
            <!-- Affichage de chaque produit -->
            <div class="product-list">

                <body>
                    <main class="page">
                        <section class="shopping-cart dark">
                            <div class="container">
                                <div class="block-heading">
                                    <h2>Panier</h2>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-8">
                                            <div class="items">
                                                <?php
                                                foreach ($products as $produit) {
                                                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit['ProductId'] . ";");
                                                    $image = $image->fetch_assoc();
                                                    $base64img = @base64_encode($image["Image"]);
                                                    $src = "data:image/jpeg;base64," . $base64img;

                                                    $product_item = $db->query("SELECT * FROM products WHERE ProductId=" . $produit['ProductId'] . ";");
                                                    $product_item = $product_item->fetch_assoc();
                                                    $price = $product_item["Price"];
                                                    ?>
                                                    <div class="product">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img class="img-fluid mx-auto d-block image" src="<?= $src ?>">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="info">
                                                                    <div class="row">
                                                                        <div class="col-md-5 product-name">
                                                                            <div class="product-name">
                                                                                <a href="#">
                                                                                    <?= $product_item['Name'] ?>
                                                                                </a>
                                                                                <div class="product-info">
                                                                                    description
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 quantity">
                                                                            <label for="quantity">Quantity:</label>
                                                                            <input id="quantity" type="number"
                                                                                value="<?= $produit['Quantity'] ?>"
                                                                                class="form-control quantity-input">
                                                                        </div>
                                                                        <div class="col-md-3 price">
                                                                            <span>
                                                                                <?php echo $price ?> €
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="summary">
                                                <h3>Summary</h3>
                                                <div class="summary-item"><span class="text">Subtotal</span><span
                                                        class="price"><?=$cartId["TotalPrice"]?>€</span></div>
                                                <div class="summary-item"><span class="text">Discount</span><span
                                                        class="price">$0</span></div>
                                                <div class="summary-item"><span class="text">Shipping</span><span
                                                        class="price">5€</span></div>
                                                <div class="summary-item"><span class="text">Total</span><span
                                                        class="price"><?=$cartId["TotalPrice"]+5?>€</span></div>
                                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='checkout';">Checkout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </body>
                <?php
                ;

        } else {
            echo "<h1>Votre panier est vide</h1>";
        }

    } else {
        echo "connectez vous pour voir votre panier";
    }
    ?>

</body>

</html>