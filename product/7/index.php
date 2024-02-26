
    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pepsi</title>
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
                    <img class="img-fluid" src="data:image/jpeg;base64," alt="ProductS">
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="main-description px-2">
                    <div class="vendor text-bold">
                        Vendue par Rolex
                    </div>
                    <div class="product-title text-bold my-3">
                        Pepsi
                    </div>


                    <div class="price-area my-4">
                    <p class="old-price mb-1">Catégorie : acier inoxydable</p>
                        <p class="new-price text-bold mb-1"><?php if (30000 > 1000) {
                            echo substr_replace(30000, ",", -3, 0);
                        } else {
                            echo 30000;
                        } ?>  €</p>
                        <p class="text-secondary mb-1">(Quantité restante : 92)</p>
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
                                <input type="text" name="product-name" id="product-name" value="Pepsi" hidden>
                                <input type="number" name="product-id" id="product-id" value=<?php echo basename(__DIR__)?> hidden>
                            </form>                            
                        </div>
                    </div>




                </div>

                <div class="product-details my-4">
                    <p class="details-title text-color mb-1">Product Details</p>
                    <p class="description">Rolex rouge girse</p>
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
    