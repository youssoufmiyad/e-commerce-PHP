
    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>so</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style><?php include("../../CSS/style.css") ?></style>
        <style><?php include("../../CSS/detail_product.css") ?></style>

    </head>
    <body>
    <?php require_once('../../navbar.php'); ?>
    
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5">
                <div class="main-img">
                    <img class="img-fluid" src="data:image/jpeg;base64,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" alt="ProductS">
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="main-description px-2">
                    <div class="vendor text-bold">
                        Vendue par 10
                    </div>
                    <div class="product-title text-bold my-3">
                        so
                    </div>


                    <div class="price-area my-4">
                    <p class="old-price mb-1">Catégorie : </p>
                        <p class="new-price text-bold mb-1"><?php if (29 > 1000) {
                            echo substr_replace(29, ",", -3, 0);
                        } else {
                            echo 29;
                        } ?>  €</p>
                        <p class="text-secondary mb-1">(Quantité restante : 383)</p>
                    </div>


                    <div class="buttons d-flex my-5">
                        <div class="block">
                            <a href="#" class="shadow btn custom-btn ">Wishlist</a>
                        </div>
                        <div class="block">
                            <button type="submit" form="form-cart" class="shadow btn custom-btn" >ajouter au panier</button>
                        </div>
                        <div class="block quantity">
                            <form action="../add_to_cart.php" id="form-cart" method="post">
                                <input type="number" class="form-control" id="cart-quantity" value="1" min="1" max="5" name="cart-quantity">

                                <!-- export du nom du produit (caché du client grace à l'attribut "hidden") -->
                                <input type="text" name="product-name" id="product-name" value="so" hidden>
                                <input type="number" name="product-id" id="product-id" value=<?php echo basename(__DIR__)?> hidden>
                            </form>                            
                        </div>
                    </div>




                </div>

                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Product Details</p>
                    <p class="description"></p>
                </div>
              


                <div class="delivery my-4">
                    <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-truck"></i></span> <b>Delivery done in 3 days from date of purchase</b> </p>
                    <p class="text-secondary">Order now to get this product delivery</p>
                </div>
                <div class="delivery-options my-4">
                    <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-filter"></i></span> <b>Delivery options</b> </p>
                    <p class="text-secondary">FEDEX</p>
                </div>
                
             
            </div>
        </div>

    </body>
    </html> 
    