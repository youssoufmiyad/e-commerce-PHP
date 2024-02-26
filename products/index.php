<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Boutique - Prestige</title>
    <link href="../CSS/products.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<?php
session_start();
$list_categories = array();
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
$categories = $db->query("SELECT Category FROM products");
foreach ($categories as $category) {
    if (!array_search($category["Category"], $list_categories)) {
        array_push($list_categories, $category["Category"]);
    }
}
?>

<body>
    <?php require_once('../navbar.php'); ?>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="collapsibleNavId">Catégorie :
                <form action="" method="get">
                    <?php
                    foreach ($list_categories as $value) {

                        echo '
                        <label for="category">' . $value . '</label>
                        <input type="checkbox" name="category[]" value="' . $value . '">
                        <br>';

                    }
                    ?>
                    <input class="form-control me-sm-2" type="text" name="search" placeholder="Search" />
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        Chercher
                    </button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        <main>
            <?php
            // Requête de selection du produit à la base de données
            if (isset($_GET["category"])) {
                $c_query = 'Category="' . $_GET["category"][0] . '"';
                foreach ($_GET["category"] as $key => $value) {
                    if ($key !== "0") {
                        $c_query .= 'OR Category="' . $value . '"';
                    }

                }
                if (isset($_GET["search"]) && $_GET["search"]!=="") {
                    $produits = $db->query('SELECT * FROM products WHERE (' . $c_query . ') AND Name LIKE "%' . $_GET["search"] . '%" AND (UserId IS NULL AND Vendor NOT LIKE "NULL")');
                } else {
                    $produits = $db->query('SELECT * FROM products WHERE (' . $c_query . ') AND (UserId IS NULL AND Vendor NOT LIKE "NULL")');

                }
            } else if (isset($_GET["search"]) && $_GET["search"]!=="") {
                $produits = $db->query('SELECT * FROM products WHERE Name LIKE "%' . $_GET["search"] . '%" AND (UserId IS NULL AND Vendor NOT LIKE "NULL")');
            } else {
                $produits = $db->query('SELECT * FROM products WHERE UserId IS NULL');

            }
            if (@$produits->num_rows > 0) {
                ?>
                <!-- affichage de chaque produit -->
                <?php
                foreach ($produits as $produit) {

                    $image = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $produit["ProductId"] . ";");
                    $image = $image->fetch_assoc();
                    $base64img = @base64_encode($image["Image"]);
                    $src = "data:file/png;base64," . $base64img;
                    ?>
                    <div class="watch">
                        <img src="<?php echo $src ?>" alt="Rolex Pepsi" class="watch-image" />
                        <h2><a href="../product/<?= $produit['ProductId'] ?>">
                                <?= $produit['Name'] ?>
                            </a></h2>
                        <h6>
                            <?= $produit['Category'] ?>
                            </h3>
                            <p>
                                <?= $produit['Description'] ?>
                            </p>
                            <div class="price">
                                <?php if (strlen($produit['Price']) > 3) {
                                    echo substr_replace($produit['Price'], ",", -3, 0);
                                } else {
                                    echo $produit['Price'];
                                } ?> €
                            </div>
                            <form action="../product/add_to_cart.php" method="POST" id="add_to_cart">
                                <input type="text" name="product-id" value=<?= $produit['ProductId'] ?> hidden>
                                <input type="text" name="product-name" value=<?= $produit['Name'] ?> hidden>
                                <input type="number" name="cart-quantity" value="1" hidden>
                            </form>
                            <input type="submit" class="btn btn-primary" form="add_to_cart" value="Acheter" />

                            <br>
                    </div>

                    <?php
                }
                ?>
        </div>
        <?php
            } else {
                ?>
        <h1>aucun produit correspondant</h1>
        <?php
            }
            ?>
    </main>
    </div>
</body>

</html>