<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../utils/connect.php');

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
    // Requête de selection des produit à la base de données
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
    ?>
</body>

</html>