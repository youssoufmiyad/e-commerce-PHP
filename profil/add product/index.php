<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../utils/connect.php');

?>
<?php
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (!empty($_POST['product-name']) && !empty($_POST['price']) && !empty($_FILES['productImage'])) {
        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $vendor = "NULL";
        $quantity = 1;
        $image = file_get_contents($_FILES['productImage']['tmp_name']);

        // Requête d'insert du produit à la base de données
        $postQuery = $db->prepare("INSERT INTO `products` (`Name`, `Price`, `Vendor`, `Quantity`, `UserId`) VALUES (?,?,?,?,?);");
        $postQuery->bind_param("ssssi", $name, $price, $vendor, $quantity, $_SESSION["user"]["userId"]);

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
    <div>
        <span>Ajout d'un produit</span>
        <form method="post" enctype="multipart/form-data">
            <label for="product-name">Nom du produit :</label>
            <input type="text" name="product-name" id="product-name" placeholder="entrez un nom">
            <br>

            <label for="price">Prix :</label>
            <input type="number" step="any" name="price" id="price" placeholder="entrez un prix">
            <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

            <label for="productImage">Image</label>
            <input type="file" name="productImage" id="productImage" accept="image/png, image/gif, image/jpeg"><br>


            <button>postez</button>
        </form>
    </div>
</body>

</html>