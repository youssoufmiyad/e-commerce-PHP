<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
    <style>
        <?php include("../../CSS/main.css") ?>
    </style>
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../utils/connect.php');
ini_set("post_max_size", "30M");
ini_set("upload_max_filesize", "30M");
ini_set("memory_limit", "20000M");
echo ini_get("upload_max_filesize");

?>
<?php
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (!empty($_POST['product-name']) && !empty($_POST['price'])) {
        $ROOT = ".";
        foreach ($_FILES as $file => $details) {   // Move each file from its temp directory to $ROOT
            echo "tmp : " . $details['tmp_name'];
            echo "\nname : " . $details['name'];
            $temp = $details['tmp_name'];
            $target = $details['name'];
            move_uploaded_file($temp, $ROOT . '/' . $target);
        }

        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $description = $_POST['descritpion'];
        $category = $_POST['category'];
        $vendor = "NULL";

        $image = file_get_contents($_FILES['productImage']['name']);
        $info = getimagesize($_FILES["productImage"]["name"]);
        $extension = image_type_to_extension($info[2]);

        // Requête d'insert du produit à la base de données
        $postQuery = $db->prepare("INSERT INTO `products` (`Name`, `Price`,`Description`, `Category`, `Vendor`, `Quantity`, `UserId`) VALUES (?,?,?,?,?,1,?);");
        $postQuery->bind_param("sssssi", $name, $price, $description, $category, $vendor, $_SESSION["user"]["userId"]);

        try {
            // Execution de la requête
            $postQuery->execute();
            echo "Produit ajouté avec succès !";

            // Selection de l'ID du produit que l'on vient d'introduire, cette information servira pour l'ajout de l'image
            $result = $db->query("SELECT ProductId from products WHERE Name='$name' AND Price=$price AND UserId=".$_SESSION["user"]["userId"]);
            $actualProduct = $result->fetch_assoc();

            // Requête d'insert du produit à la base de données
            $addPhoto = $db->prepare("INSERT INTO `products_photo` (`ProductId`, `Image`) VALUES (?,?);");
            $addPhoto->bind_param("ss", $actualProduct["ProductId"], $image);
            $addPhoto->execute();
            echo "Photo ajouté avec succès !";
            unlink($_FILES["productImage"]["name"]);

        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>

<body>
    <?php require_once('../../navbar.php'); ?>
    <div>
        <span>Ajout d'un produit</span>
        <form method="post" enctype="multipart/form-data">
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

            <label for="category">Category :</label>
            <input type="text" name="category" id="category" placeholder="montre en or, acier, de sport, etc...">
            <br>

            <input type="hidden" name="MAX_FILE_SIZE" value="999999999999" />

            <label for="productImage">Image</label>
            <input type="file" name="productImage" id="productImage" accept="image/png, image/gif, image/jpeg"><br>


            <button>Poster</button>
        </form>
    </div>
</body>

</html>