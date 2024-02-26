
    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>nom</title>
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
                        Vendue par NULL
                    </div>
                    <div class="product-title text-bold my-3">
                        nom
                    </div>


                    <div class="price-area my-4">
                    <p class="old-price mb-1">Catégorie : </p>
                        <p class="new-price text-bold mb-1"><?php if (99 > 1000) {
                            echo substr_replace(99, ",", -3, 0);
                        } else {
                            echo 99;
                        } ?>  €</p>
                        <p class="text-secondary mb-1">(Quantité restante : 1)</p>
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
                                <input type="text" name="product-name" id="product-name" value="nom" hidden>
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
    