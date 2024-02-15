<?php
// prise d'information sur la section actuelle
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order history</title>
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <?php
    // Test si l'utilisateur est connecté
    if (@$_SESSION["user"]) {
        $orders = $db->query('SELECT * FROM orders WHERE UserId=' . $_SESSION["user"]["userId"] . ';');
        // Test si l'utilisateur a déjà commandé
        if ($orders->num_rows > 0) {
            ?>
            <!-- Affichage de chaque produit -->
            <div class="product-list">
                <?php
                foreach ($orders as $order) {
                    $product = $db->query('SELECT * FROM products WHERE ProductId=' . $order['ProductId'] . ';');
                    $product = $product->fetch_assoc();

                    echo $order['ProductId'];
                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $order['ProductId'] . ";");
                    $image = $image->fetch_assoc();
                    $base64img = @base64_encode($image["Image"]);
                    $src = "data:image/jpeg;base64," . $base64img;
                    ?>
                    <!-- TODO : 
                    - ajouter les champs propre aux commandes tels que la date d'envoi/livraison
                    - donner la possibilité à l'utilisateur de consulter ses factures -->
                    <div class="orders-item" id="product-<?= $order['ProductId'] ?>">
                        <div class="product-name">
                            <?= $product['Name'] ?>
                        </div>
                        <div class="product-image">
                            <img src="<?= $src ?>" alt="product image">
                        </div>
                    </div>
                    <br>
                    <?php
                }

        }else{
            echo "<h1>Vous n'avez passez aucune commande</h1>";
        }
        
    } else {
        echo "connectez vous pour voir votre historique de commande";
    }
    ?>
</body>

</html>