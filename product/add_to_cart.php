<?php
// prise d'information sur la section actuelle
session_start();

// Import de la connection à la database sous la forme de la variable "$db"
require_once("../utils/connect.php");

// Variables repertoriant les infos nécessaires
$userId = $_SESSION["user"]["userId"];
$productId = $_POST["product-id"];
$productName = $_POST["product-name"];
$userName = $_SESSION["user"]["email"];
$quantity = $_POST["cart-quantity"];
$price = $db->query("SELECT Price FROM products WHERE ProductId=" . $productId . ";");
$price = $price->fetch_assoc();
$totalPrice = intval($price["Price"]) * intval($quantity);

try {
    // Requête d'insert du produit dans le panier à la base de données
    $addProduct = $db->query("INSERT INTO `cart` (`UserId`, `ProductId`, `ProductName`, `UserName`, `Quantity`, `TotalPrice`) VALUES ($userId, $productId,'$productName', '$userName', $quantity, $totalPrice);");
    echo "ajouté au panier";
} catch (\Throwable $th) {
    throw $th;
}
