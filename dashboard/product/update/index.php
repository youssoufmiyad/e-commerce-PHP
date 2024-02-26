<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>
    <link rel="stylesheet" href="../update/update.css">
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
            $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit["ProductId"] . ";");
            $image = $image->fetch_assoc();
            $base64img = @base64_encode($image["Image"]);
            $src = "data:file/png;base64," . $base64img;
    ?>
            <tr>
                <td>
                    <?= $produit['ProductId'] ?>
                </td>
                <td>
                    <img src="<?php echo $src ?>" height="32px" width="32px" />
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
                    <?= $produit['Category'] ?>
                </td>
                <td>
                    <?= $produit['Vendor'] ?>
                </td>
            </tr>
            <br>
    <?php
        }
    } ?>
    <div class="product-form">
        <h2>Modification d'un produit</h2>
        <form method="post" class="product-form__form">
            <div class="form-group">
                <label for="product-id" class="form-label">Identifiant du produit :</label>
                <input type="number" name="product-id" id="product-id" value="<?= $result['ProductId'] ?>" class="form-input" placeholder="Entrez un ID">
            </div>

            <div class="form-group">
                <label for="product-name" class="form-label">Nom du produit :</label>
                <input type="text" name="product-name" id="product-name" value="<?= $result['Name'] ?>" class="form-input" placeholder="Entrez un nom">
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Prix :</label>
                <input type="number" step="any" name="price" id="price" value="<?= $result['Price'] ?>" class="form-input" placeholder="Entrez un prix">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description :</label>
                <input type="text" name="description" id="description" value="<?= $result['Description'] ?>" class="form-input" placeholder="Entrez une description">
            </div>

            <div class="form-group">
                <label for="vendor" class="form-label">Vendeur :</label>
                <input type="text" name="vendor" id="vendor" value="<?= $result['Vendor'] ?>" class="form-input" placeholder="Entrez le nom du vendeur">
            </div>

            <div class="form-group">
                <label for="quantity" class="form-label">Quantité :</label>
                <input type="number" name="quantity" id="quantity" value="<?= $result['Quantity'] ?>" class="form-input" placeholder="Combien">
            </div>

            <button type="submit" class="btn-submit">MODIFIER</button>
        </form>
    </div>
</body>

</html>