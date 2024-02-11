<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
require_once('../dashboard/connect.php');

?>

<body>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $result = $db->query('SELECT * FROM products');
    if ($result->num_rows > 0) {
        ?>
        <div class="product-list">
            <?php
            foreach ($result as $produit) {
                ?>
                <div class="products-item" id="product-<?= $produit['ProductId'] ?>">
                    <div class="product-name">
                        <?= $produit['Name'] ?>
                    </div>
                    <div class="product-price">
                        <?= $produit['Price'] ?>
                    </div>
                    <div class="product-vendor">
                        <?= $produit['Vendor'] ?>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</body>

</html>