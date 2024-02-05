<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
require_once('../connect.php');

?>




<body>
    <div class="navbar">
        <ul>
            <li><a href="./create">Enregistrer un nouveau produit</a></li>
            <li><a href="./">Voir les produit</a></li>
            <li><a href="./update">Modifier un produit existant</a></li>
            <li><a href="./delete">Supprimer un produit</a></li>
        </ul>
    </div>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'GET':
            $result = $db->query('SELECT * FROM products');
            if ($result->num_rows > 0) {
                foreach ($result as $produit) {
                    ?>
                    <tr>
                        <td>
                            <?= $produit['ProductId'] ?>
                        </td>
                        <td>
                            <?= $produit['Name'] ?>
                        </td>
                        <td>
                            <?= $produit['Price'] ?>
                        </td>
                        <td>
                            <?= $produit['Vendor'] ?>
                        </td>
                    </tr>
                    <br>
                    <?php
                }
            }
            break;
        case 'PUT':

            break;
    }
    ?>
</body>

</html>