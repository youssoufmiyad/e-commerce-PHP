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
    <title>order history</title>
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
        $orders = $db->query('SELECT * FROM orders WHERE UserId=' . $_SESSION["user"]["userId"] . ';');
        // Test si l'utilisateur a déjà commandé
        if ($orders->num_rows > 0) {
            ?>
            <!-- Affichage de chaque produit -->
            <div class="order-list">
                <?php
                foreach ($orders as $order) {
                    $items = $db->query('SELECT * FROM order_items WHERE OrderId=' . $order['OrderId'] . ';');
                    ?>
                    <div class="orders-item" id="order-<?= $order['OrderId'] ?>">
                        <h1>ORDER
                            <?= $order['OrderId'] ?>
                        </h1>
                        <?php
                        foreach ($items as $item) {
                            $item_info = $db->query('SELECT * FROM products WHERE ProductId=' . $item['ProductId'] . ';')->fetch_assoc();
                            ?>
                            <!-- TODO : 
                    - ajouter les champs propre aux commandes tels que la date d'envoi/livraison
-->

                            <div class="product-name">
                                <?= $item_info['Name'] ?>
                            </div>

                            <?php
                        } ?>
                    </div>
                    <form action="../cart/checkout/invoice/index.php" method="post">
                        <input type="hidden" name="order-id" value="<?= $order['OrderId'] ?>">
                        <button>voir facture</button>
                    </form>
                    <br>
                    <?php
                }

        } else {
            echo "<h1>Vous n'avez passez aucune commande</h1>";
        }

    } else {
        echo "connectez vous pour voir votre historique de commande";
    }
    ?>
</body>

</html>