<?php
require_once("../dashboard/connect.php");

session_start();

$userId = $_SESSION["user"]["userId"];
$productId = $_POST["product-id"];
$productName = $_POST["product-name"];
$userName = $_SESSION["user"]["email"];
$quantity = $_POST["cart-quantity"];
$price = $db->query("SELECT Price FROM products WHERE ProductId=" . $productId . ";");
$price = $price->fetch_assoc();
$totalPrice = intval($price["Price"]) * intval($quantity);
try {
    $addProduct = $db->query("INSERT INTO `cart` (`UserId`, `ProductId`, `ProductName`, `UserName`, `Quantity`, `TotalPrice`) VALUES ($userId, $productId,'$productName', '$userName', $quantity, $totalPrice);");
    echo "ajouté au panier";
} catch (\Throwable $th) {
    throw $th;
}
