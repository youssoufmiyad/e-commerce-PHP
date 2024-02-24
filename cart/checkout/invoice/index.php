<?php
require_once("../../../utils/connect.php");
session_start();

$orderId = $_POST["order-id"];
$date = date('Y-m-d H:i:s');

$stmt = $db->prepare("INSERT INTO invoices (OrderId, UserId, InvoiceDate) VALUES (?,?,?)");
$stmt->bind_param("iis", $orderId, $_SESSION["user"]["userId"], $date);
$stmt->execute();

$order_items = $db->query("SELECT * FROM order_items WHERE OrderId=$orderId;")

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body>
    <table>
        <caption>
            Commande n°
            <?php echo $orderId ?>
        </caption>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Article</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Somme</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item) {
                $product = $db->query("SELECT Name, Price FROM products WHERE ProductId=" . $item["ProductId"])->fetch_assoc();
                $product_img = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $item["ProductId"])->fetch_assoc();
                $base64img = @base64_encode($product_img["Image"]);
                $src = "data:image/jpeg;base64," . $base64img;

                echo "<tr>";
                echo "<td><img src=$src alt=\"product photo\" width=\"64px\" height=\"64px\"/></td>";
                echo "<td>" . $product["Name"] . "</td>";
                echo "<td>" . $item["Quantity"] . "</td>";
                echo "<td>" . $product["Price"] . "€</td>";
                echo "<td>" . $item["Price"] . "€</td>";
                echo "</tr>";
            }

            ?>

        </tbody>
        <tfoot>
            <tr>
                <th scope="row" colspan="4">Total</th>
                <td>
                    <?php $Total = $db->query("SELECt TotalPrice FROM orders WHERE OrderId=$orderId")->fetch_assoc();
                    echo $Total["TotalPrice"] ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <br>

</body>

</html>