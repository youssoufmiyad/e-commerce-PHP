<?php
require_once('./dashboard/connect.php');

$products = $db->query(
    "SELECT * FROM products"
);
$json = [];

if ($products->num_rows > 0) {
    // output data of each row
    while ($row = $products->fetch_assoc()) {
        if (!file_exists("product/" . $row["ProductId"] . "/index.php")) {
            mkdir("product/" . $row["ProductId"] . "/", 0777, true);
            $file = fopen("product/" . $row["ProductId"] . "/index.php", "w") or die("Unable to open file!");
            $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=".$row["ProductId"].";");
            $image = $image->fetch_assoc();
            $base64img = @base64_encode($image["Image"]);
            $src= "data:image/jpeg;base64,". $base64img;
            productDetailTemplate($file, $row["Name"], $row["Price"], $row["Vendor"], $row["Quantity"],$src);
            fclose($file);
        }
        array_push($json, $row);
    }
}

function productDetailTemplate($file, $name, $price, $vendor, $quantity, $image)
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
        <div class=\"product-vendor\">$vendor </div>
        <div class=\"product-quantity\">$quantity </div>
        <div class=\"product-image\"><img src=\"$image\" alt=\"product image\"/></div>
    </body>
    </html>
    ");


}