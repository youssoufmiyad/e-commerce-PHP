<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../../utils/connect.php');

?>
<?php
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (!empty($_POST['product-id']) && !empty($_POST['product-name']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['vendor']) && !empty($_POST['quantity'])) {
        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $vendor = $_POST['vendor'];
        $quantity = $_POST['quantity'];
        $id = $_POST['product-id'];
        $produits = $db->query('SELECT * FROM products WHERE ProductId=' . $id . ';');

        // Requête de modification du produit existant à la base de données
        $postQuery = $db->prepare("UPDATE `products` SET `Name`=?, `Price`=?, `Description`=?, `Vendor`=?, `Quantity`=? WHERE `ProductId`=?;");
        $postQuery->bind_param("ssssss", $name, $price, $description, $vendor, $quantity, $id);

        try {
            $postQuery->execute();
            echo "Produit modifié avec succès !";
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>

<body>
    <div class="navbar">
        <ul>
            <li><a href="../create">Enregistrer un nouveau produit</a></li>
            <li><a href="../">Voir les produit</a></li>
            <li><a href="./">Modifier un produit existant</a></li>
            <li><a href="../delete">Supprimer un produit</a></li>
        </ul>
    </div>
    <?php
    $produits = $db->query('SELECT * FROM products');
    if ($produits->num_rows > 0) {
        foreach ($produits as $produit) {
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
                    <?= $produit['Description'] ?>
                </td>
                <td>
                    <?= $produit['Vendor'] ?>
                </td>
            </tr>
            <br>
            <?php
        }
    } ?>
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

            <label for="description">Nom du produit :</label>
            <input type="text" name="description" id="description" value="<?= $result['Description'] ?>"
                placeholder="entrez un description">
            <br>

            <label for="vendor">Vendeur :</label>
            <input type="text" name="vendor" id="vendor" value="<?= $result['Vendor'] ?>"
                placeholder="entrez le nom du vendeur">
            <br>

            <label for="quantity">Quantité :</label>
            <input type="number" name="quantity" id="quantity" value="<?= $result['Quantity'] ?>"
                placeholder="combien :">
            <br>

            <button>MODIFIER</button>
        </form>
    </div>
</body>

</html>