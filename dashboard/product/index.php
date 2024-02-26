<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Prestige</title>
    <link rel="stylesheet" href="../../dashboard/css/dashboard.css">
</head>

<body>
    <div class="navbar">
        <ul class="nav">
            <li><a href="./create" class="nav-link">Enregistrer un nouveau produit</a></li>
            <li><a href="./" class="nav-link active">Voir les produits</a></li>
            <li><a href="./update" class="nav-link">Modifier un produit existant</a></li>
            <li><a href="./delete" class="nav-link">Supprimer un produit</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="product-header">
            <span class="header-item">ID</span>
            <span class="header-item">Nom</span>
            <span class="header-item">Prix</span>
            <span class="header-item">Vendeur</span>
        </div>
        <?php
        // Import de la connexion à la base de données sous la forme de la variable "$db"
        require_once('../../utils/connect.php');

        // Requête de sélection des produits dans la base de données
        $result = $db->query('SELECT * FROM products');
        if ($result->num_rows > 0) {
            foreach ($result as $produit) {
        ?>
                <div class="product">
                    <span class="product-info"><?= $produit['ProductId'] ?></span>
                    <span class="product-info"><?= $produit['Name'] ?></span>
                    <span class="product-info"><?= $produit['Price'] ?></span>
                    <span class="product-info"><?= $produit['Vendor'] ?></span>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

</html>