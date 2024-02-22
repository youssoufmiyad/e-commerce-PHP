<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('connect.php');
// Import de la fonction de templating
require_once("productDetailTemplate.php");

$products = $db->query(
    "SELECT * FROM products"
);

if ($products->num_rows > 0) {
    while ($row = $products->fetch_assoc()) {
        if (!file_exists("product/" . $row["ProductId"] . "/index.php")) {
            // Création du dossier contenant la page du produit s'il s'agit d'un nouveau produit
            mkdir("product/" . $row["ProductId"] . "/", 0777, true);
        }
        // Création/ouverture du fichier de la page du produit
        $file = fopen("product/" . $row["ProductId"] . "/index.php", "w") or die("Unable to open file!");

        // Chargement de l'image
        $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $row["ProductId"] . ";");
        $image = $image->fetch_assoc();
        $base64img = @base64_encode($image["Image"]);
        $src = "data:image/jpeg;base64," . $base64img;

        // Ajout des données du produit dans la template
        productDetailTemplate($file, $row["Name"], $row["Price"], $row["Description"], $row["Vendor"], $row["Quantity"], $src);

        // Fermeture du fichier
        fclose($file);
    }
}


