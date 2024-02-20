<?php
function productDetailTemplate($file, $name, $price, $vendor, $quantity, $image)
{
    fwrite($file, "
    <!DOCTYPE html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>$name</title>
        <style><?php include(\"../../CSS/main.css\") ?></style>
    </head>
    <body>
    <?php require_once('../../navbar.php'); ?>
        <div class=\"product-name\" >$name</div>
        <div class=\"product-price\">$price €</div>
        <div class=\"product-vendor\">$vendor </div>
        <div class=\"product-quantity\">$quantity </div>
        <div class=\"product-image\"><img src=\"$image\" alt=\"product image\"/></div>
        <form action=\"../add_to_cart.php\" method=\"post\">
        <label for=\"cart-quantity\">combien ?</label>
        <input type=\"number\" name=\"cart-quantity\" id=\"cart-quantity\">

        <!-- export du nom du produit (caché du client grace à l'attribut \"hidden\") -->
        <input type=\"text\" name=\"product-name\" id=\"product-name\" value=\"$name\" hidden>
        <input type=\"number\" name=\"product-id\" id=\"product-id\" value=<?php echo basename(__DIR__)?> hidden>
        <input type=\"submit\" value=\"ajouter au panier\">
    </form>
    </body>
    </html> 
    ");


}