<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create product</title>
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
    if (!empty($_POST['product-name']) && !empty($_POST['price']) && !empty($_POST['descritpion']) && !empty($_POST['vendor']) && !empty($_POST['quantity']) && !empty($_FILES['productImage'])) {
        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $vendor = $_POST['vendor'];
        $quantity = $_POST['quantity'];
        $image = file_get_contents($_FILES['productImage']['tmp_name']);

        // Requête d'insert du produit à la base de données
        $postQuery = $db->prepare("INSERT INTO `products` (`Name`, `Price`,`Description` `Vendor`, `Quantity`) VALUES (?,?,?,?,?);");
        $postQuery->bind_param("sssss", $name, $price, $description, $vendor, $quantity);

        try {
            // Execution de la requête
            $postQuery->execute();
            echo "Produit ajouté avec succès !";

            // Selection de l'ID du produit que l'on vient d'introduire, cette information servira pour l'ajout de l'image
            $result = $db->query("SELECT ProductId from products WHERE Name='$name' AND Price=$price AND Vendor='$vendor' AND Quantity='$quantity'");
            $actualProduct = $result->fetch_assoc();

            // Requête d'insert du produit à la base de données
            $addPhoto = $db->prepare("INSERT INTO `products_photo` (`ProductId`, `Image`) VALUES (?,?);");
            $addPhoto->bind_param("ss", $actualProduct["ProductId"], $image);
            $addPhoto->execute();
            echo "Photo ajouté avec succès !";

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
            <li><a href="./">Enregistrer un nouveau produit</a></li>
            <li><a href="../">Voir les produit</a></li>
            <li><a href="../update">Modifier un produit existant</a></li>
            <li><a href="../delete">Supprimer un produit</a></li>
        </ul>
    </div>
    <div>
        <span>Création d'un produit</span>
        <form method="post" enctype="multipart/form-data">
            <label for="product-name">Nom du produit :</label>
            <input type="text" name="product-name" id="product-name" placeholder="entrez un nom">
            <br>

            <label for="price">Prix :</label>
            <input type="number" step="any" name="price" id="price" placeholder="entrez un prix">
            <br>

            <label for="descritpion">Description :</label>
            <input type="text" name="descritpion" id="descritpion" placeholder="entrez une descritpion">
            <br>

            <label for="vendor">Vendeur :</label>
            <input type="text" name="vendor" id="vendor" placeholder="entrez le nom du vendeur">
            <br>

            <label for="quantity">Quantité :</label>
            <input type="number" name="quantity" id="quantity" placeholder="combien :">
            <br>

            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

            <label for="productImage">Image</label>
            <input type="file" name="productImage" id="productImage" accept="image/png, image/gif, image/jpeg"><br>


            <button>test style bouton</button>
        </form>
    </div>
</body>

</html>