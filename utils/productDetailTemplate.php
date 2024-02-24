<?php
function productDetailTemplate($file, $name, $price, $description, $vendor, $quantity, $image)
{
    fwrite($file, "
    <!DOCTYPE html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>$name</title>
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <style><?php include(\"../../CSS/main.css\") ?></style>
        <style><?php include(\"../../CSS/detail_product.css\") ?></style>

    </head>
    <body>
    <?php require_once('../../navbar.php'); ?>
    
    <div class=\"container my-5\">
        <div class=\"row\">
            <div class=\"col-md-5\">
                <div class=\"main-img\">
                    <img class=\"img-fluid\" src=\"$image\" alt=\"ProductS\">
                    
                </div>
            </div>
            <div class=\"col-md-5\">
                <div class=\"main-description px-2\">
                    <div class=\"category text-bold\">
                        Vendue par $vendor
                    </div>
                    <div class=\"product-title text-bold my-3\">
                        $name
                    </div>


                    <div class=\"price-area my-4\">
                    <p class=\"old-price mb-1\">Quantité restante : $quantity</p>
                        <p class=\"new-price text-bold mb-1\">$price €</p>
                        <p class=\"text-secondary mb-1\">(Additional tax may apply on checkout)</p>
                    </div>


                    <div class=\"buttons d-flex my-5\">
                        <div class=\"block\">
                            <a href=\"#\" class=\"shadow btn custom-btn \">Wishlist</a>
                        </div>
                        <div class=\"block\">
                            <button type=\"submit\" form=\"form-cart\" class=\"shadow btn custom-btn\" >ajouter au panier</button>
                        </div>
                        <div class=\"block quantity\">
                            <form action=\"../add_to_cart.php\" id=\"form-cart\" method=\"post\">
                                <input type=\"number\" class=\"form-control\" id=\"cart-quantity\" value=\"1\" min=\"1\" max=\"5\" name=\"cart-quantity\">

                                <!-- export du nom du produit (caché du client grace à l'attribut \"hidden\") -->
                                <input type=\"text\" name=\"product-name\" id=\"product-name\" value=\"$name\" hidden>
                                <input type=\"number\" name=\"product-id\" id=\"product-id\" value=<?php echo basename(__DIR__)?> hidden>
                            </form>                            
                        </div>
                    </div>




                </div>

                <div class=\"product-details my-4\">
                    <p class=\"details-title text-color mb-1\">Product Details</p>
                    <p class=\"description\">$description</p>
                </div>
              
                         <div class=\"row questions bg-light p-3\">
                    <div class=\"col-md-1 icon\">
                        <i class=\"fa-brands fa-rocketchat questions-icon\"></i>
                    </div>
                    <div class=\"col-md-11 text\">
                        Have a question about our products at E-Store? Feel free to contact our representatives via live chat or email.
                    </div>
                </div>

                <div class=\"delivery my-4\">
                    <p class=\"font-weight-bold mb-0\"><span><i class=\"fa-solid fa-truck\"></i></span> <b>Delivery done in 3 days from date of purchase</b> </p>
                    <p class=\"text-secondary\">Order now to get this product delivery</p>
                </div>
                <div class=\"delivery-options my-4\">
                    <p class=\"font-weight-bold mb-0\"><span><i class=\"fa-solid fa-filter\"></i></span> <b>Delivery options</b> </p>
                    <p class=\"text-secondary\">View delivery options here</p>
                </div>
                
             
            </div>
        </div>

    </body>
    </html> 
    ");


}