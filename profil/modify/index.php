<?php
session_start();
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../utils/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/profil.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <title>modify</title>
</head>

<?php
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (isset($_POST['product-id']) && isset($_POST['product-name']) && isset($_POST['price']) && isset($_POST['vendor']) && isset($_POST['quantity'])) {
        $name = $_POST['product-name'];
        $price = $_POST['price'];
        $vendor = $_POST['vendor'];
        $quantity = $_POST['quantity'];
        $id = $_POST['product-id'];
        $produits = $db->query('SELECT * FROM products WHERE ProductId=' . $id . ';');

        // Requête de modification du produit existant à la base de données
        $postQuery = $db->prepare("UPDATE `products` SET `Name`=?, `Price`=?, `Vendor`=?, `Quantity`=? WHERE `ProductId`=?;");
        $postQuery->bind_param("sssss", $name, $price, $vendor, $quantity, $id);

        try {
            $postQuery->execute();
            echo "Produit modifié avec succès !";
            header("location: ../");
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>


<body>
    <?php require_once('../../navbar.php'); ?>
    <div class="form-container">

        <form method="post" action="change-info.php">
            <span><strong>Informations du compte:</strong></span><br>
            <label for="form-lastname">Last name:</label><br>
            <input type="text" id="form-lastname" name="form-lastname" value=<?php echo $_SESSION["user"]["lastName"] ?>><br><br>
            <label for="form-firstname">First name:</label><br>
            <input type="text" id="form-firstname" name="form-firstname" value=<?php echo $_SESSION["user"]["firstName"] ?>><br>
            <label for="form-email">Email:</label><br>
            <input type="text" id="form-email" name="form-email" value=<?php echo $_SESSION["user"]["email"] ?>><br><br>
            <input type="submit" value="Submit"><br><br>
        </form>

        <form method="post" action="change-password.php">
            <span><strong>Mot de passe:</strong></span><br>
            <label for="form-old-password">Old password:</label><br>
            <input type="password" id="form-old-password" name="form-old-password"><br><br>
            <label for="form-password">New password:</label><br>
            <input type="password" id="form-password" name="form-password"><br><br>
            <label for="form-confirmPWD">Confirm password:</label><br>
            <input type="password" id="form-confirmPWD" name="form-confirmPWD"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>