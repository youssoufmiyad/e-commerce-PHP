<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete product</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../../utils/connect.php');

?>
<?php
// Envoi du formulaire de supression d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage du champ "product-id" coté serveur
    if (isset($_POST['product-id'])) {
        $id = $_POST['product-id'];

        // Requête d'insert du produit à la base de données
        $postQuery = $db->prepare("DELETE from `products` WHERE `ProductId`=?;");
        $postQuery->bind_param("s", $id);

        try {
            $postQuery->execute();
            echo "Produit supprimé avec succès !";
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("Identifiant du produit non renseigné", 1);

    }
}

?>

<body>
    <div class="navbar">
        <ul>
            <li><a href="../create">Enregistrer un nouveau produit</a></li>
            <li><a href="../">Voir les produit</a></li>
            <li><a href="../update">Modifier un produit existant</a></li>
            <li><a href="./">Supprimer un produit</a></li>
        </ul>
    </div>

    <div>
        <span>Supression d'un produit</span>
        <br>
        <?php
        $produits = $db->query('SELECT * FROM products');
        if ($produits->num_rows > 0) {
            foreach ($produits as $produit) {
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
                        <?= $produit['Description'] ?>
                    </td>
                    <td>
                        <?= $produit['Vendor'] ?>
                    </td>
                </tr>
                <br>
                <?php
            }
        } ?>
        <form method="post">
            <label for="product-id">Identifiant du produit :</label>
            <input type="number" name="product-id" id="product-id" placeholder="entrez un id">
            <br>


            <button>supprimer</button>
        </form>
    </div>
</body>

</html>