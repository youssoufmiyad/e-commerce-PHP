<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<?php
require_once('connect.php');

?>


<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $result = $db->query('SELECT * FROM products');
        if ($result->num_rows > 0) {
            foreach ($result as $produit) {
                ?>
                <tr>
                    <td>
                        <?= $produit['ProductId'] ?>
                    </td>
                    <td>
                        <?= $produit['Name'] ?>
                    </td>
                    <td>
                        <?= $produit['Price'] ?>
                    </td>
                    <td>
                        <?= $produit['Vendor'] ?>
                    </td>
                </tr>
                <?php
            }
        }
        break;
    case 'POST':
        
        if (isset($_POST['product-name']) && isset($_POST['price']) && isset($_POST['vendor']) && isset($_POST['quantity'])) {
            $name = $_POST['product-name'];
            $price = $_POST['price'];
            $vendor = $_POST['vendor'];
            $quantity = $_POST['quantity'];

            $postQuery = $db->prepare("INSERT INTO `products` (`Name`, `Price`, `Vendor`, `Quantity`) VALUES (?,?,?,?);");
            $postQuery->bind_param("ssss", $name, $price, $vendor, $quantity);
            try {
                $postQuery->execute();
                echo "Produit ajouté avec succès !";
            } catch (Exception $e) {
                throw $e;
            }
        }else{
            throw new Exception("Post params empty", 1);
            
        }
        break;
}
?>

<body>
    <div>
        <span>Création d'un produit</span>
        <form method="post">
            <label for="product-name">Nom du produit :</label>
            <input type="text" name="product-name" id="product-name" placeholder="entrez un nom">
            <br>

            <label for="price">Prix :</label>
            <input type="number" step="any" name="price" id="price" placeholder="entrez un prix">
            <br>

            <label for="vendor">Vendeur :</label>
            <input type="text" name="vendor" id="vendor" placeholder="entrez le nom du vendeur">
            <br>

            <label for="quantity">Quantité :</label>
            <input type="number" name="quantity" id="quantity" placeholder="combien :">
            <br>

            <input type="submit"/>
        </form>
    </div>
</body>

</html>