<?php
require_once('./dashboard/connect.php');

$products = $db->query(
    "SELECT * FROM products"
);
$db->close();
$json = [];

if ($products->num_rows > 0) {
    // output data of each row
    while ($row = $products->fetch_assoc()) {
        if (!file_exists("product/" . $row["ProductId"] . "/index.php")) {
            mkdir("product/" . $row["ProductId"] . "/", 0777, true);
            $file = fopen("product/" . $row["ProductId"] . "/index.php", "w") or die("Unable to open file!");
            productDetailTemplate($file, $row["Name"], $row["Price"], $row["Vendor"], $row["Quantity"]);
            fclose($file);
        }
        array_push($json, $row);
    }
}

function productDetailTemplate($file, $name, $price, $vendor, $quantity)
{
    fwrite($file, "
    <!DOCTYPE html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>$name</title>
        <link rel=\"stylesheet\" href=\"../../CSS/main.css\">
    </head>
    <body>
        <div class=\"product-name\" >$name</div>
        <div class=\"product-price\">$price €</div>
        <div class=\"product-vendor\">$vendor €</div>
        <div class=\"product-quantity\">$quantity €</div>
    </body>
    </html>
    ");


}