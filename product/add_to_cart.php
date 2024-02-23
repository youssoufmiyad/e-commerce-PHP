<?php
// prise d'information sur la section actuelle
session_start();

// Import de la connection à la database sous la forme de la variable "$db"
require_once("../utils/connect.php");

// Variables repertoriant les infos nécessaires
$userId = $_SESSION["user"]["userId"];
$productId = $_POST["product-id"];
$quantity = $_POST["cart-quantity"];
$price = $db->query("SELECT Price FROM products WHERE ProductId=" . $productId . ";");
$price = $price->fetch_assoc();
$totalPrice = intval($price["Price"]) * intval($quantity);

$cart = $db->query("SELECT * FROM cart WHERE UserId=" . $userId . ";");
if ($cart->num_rows > 0) {
    try {
        $cartData = $cart->fetch_assoc();
        // Requête d'insert du produit dans le panier à la base de données
        $addProduct = $db->query("INSERT INTO `cart_items` (`CartId`, `ProductId`, `Quantity`, `Price`) VALUES (" . $cartData["CartId"] . ", $productId,$quantity," . $totalPrice . ");");
        echo "ajouté au panier";
        $db->query("UPDATE `cart` SET `TotalPrice`=" . intval($cartData["TotalPrice"]) + intval($totalPrice) . " WHERE `UserId`=" . $userId . ";");
    } catch (\Throwable $th) {
        throw $th;
    }
} else {
    $db->query("INSERT INTO cart (`UserId`, `TotalPrice`) VALUES ($userId, 0);");
    try {
        $cartId = $db->query("SELECT * FROM cart WHERE UserId=" . $userId . ";")->fetch_assoc();
        // Requête d'insert du produit dans le panier à la base de données
        $addProduct = $db->query("INSERT INTO `cart_items` (`CartId`, `ProductId`, `Quantity`, `Price`) VALUES (" . $cartId["CartId"] . ", $productId,$quantity," . $totalPrice . ");");
        echo "ajouté au panier";
        $db->query("UPDATE `cart` SET `TotalPrice`=" . intval($cartId["TotalPrice"]) + intval($totalPrice) . " WHERE `UserId`=" . $userId . ";");
        // Requête d'insert du produit dans le panier à la base de données
    } catch (\Throwable $th) {
        throw $th;
    }
}

