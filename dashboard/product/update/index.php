<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create product</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
require_once('../../connect.php');

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['product-id']) && isset($_POST['product-name']) && isset($_POST['price']) && isset($_POST['vendor']) && isset($_POST['quantity'])) {
        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $vendor = $_POST['vendor'];
        $quantity = $_POST['quantity'];
        $id = $_POST['product-id'];
        $result = $db->query('SELECT * FROM products WHERE ProductId=' . $id . ';');


        $postQuery = $db->prepare("UPDATE `products` SET `Name`=?, `Price`=?, `Vendor`=?, `Quantity`=? WHERE `ProductId`=?;");
        $postQuery->bind_param("sssss", $name, $price, $vendor, $quantity, $id);
        try {
            $postQuery->execute();
            echo "Produit modifié avec succès !";
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("Post params empty", 1);

    }
}

?>

<body>
    <div class="navbar">
        <ul>
            <li><a href="./create">Enregistrer un nouveau produit</a></li>
            <li><a href="../">Voir les produit</a></li>
            <li><a href="./update">Modifier un produit existant</a></li>
            <li><a href="./delete">Supprimer un produit</a></li>
        </ul>
    </div>
    <div>
        <span>Modification d'un produit</span>
        <form method="post">
            <label for="product-id">Identifiant du produit :</label>
            <input type="number" name="product-id" id="product-id" value="<?= $result['ProductId'] ?>"
                placeholder="entrez un id">
            <br>

            <label for="product-name">Nom du produit :</label>
            <input type="text" name="product-name" id="product-name" value="<?= $result['Name'] ?>"
                placeholder="entrez un nom">
            <br>

            <label for="price">Prix :</label>
            <input type="number" step="any" name="price" id="price" value="<?= $result['Price'] ?>"
                placeholder="entrez un prix">
            <br>

            <label for="vendor">Vendeur :</label>
            <input type="text" name="vendor" id="vendor" value="<?= $result['Vendor'] ?>"
                placeholder="entrez le nom du vendeur">
            <br>

            <label for="quantity">Quantité :</label>
            <input type="number" name="quantity" id="quantity" value="<?= $result['Quantity'] ?>"
                placeholder="combien :">
            <br>

            <button>test style bouton</button>
        </form>
    </div>
</body>

</html>