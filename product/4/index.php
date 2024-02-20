
    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>nouveau produit que</title>
        <style><?php include("../../CSS/main.css") ?></style>
    </head>
    <body>
    <?php require_once('../../navbar.php'); ?>
        <div class="product-name" >nouveau produit que</div>
        <div class="product-price">84.22 €</div>
        <div class="product-vendor">NULL </div>
        <div class="product-quantity">1 </div>
        <div class="product-image"><img src="data:image/jpeg;base64," alt="product image"/></div>
        <form action="../add_to_cart.php" method="post">
        <label for="cart-quantity">combien ?</label>
        <input type="number" name="cart-quantity" id="cart-quantity">

        <!-- export du nom du produit (caché du client grace à l'attribut "hidden") -->
        <input type="text" name="product-name" id="product-name" value="nouveau produit que" hidden>
        <input type="number" name="product-id" id="product-id" value=<?php echo basename(__DIR__)?> hidden>
        <input type="submit" value="ajouter au panier">
    </form>
    </body>
    </html> 
    