<?php
session_start();
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../utils/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include("../../CSS/main.css") ?></style>
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
    <span>Informations du compte</span>
    <form method="post" action="change-info.php">
        <label for="form-lastname">Last name:</label><br>
        <input type="text" id="form-lastname" name="form-lastname" value=<?php echo $_SESSION["user"]["lastName"] ?>><br><br>
        <label for="form-firstname">First name:</label><br>
        <input type="text" id="form-firstname" name="form-firstname" value=<?php echo $_SESSION["user"]["firstName"] ?>><br>
        <label for="form-email">Email:</label><br>
        <input type="text" id="form-email" name="form-email" value=<?php echo $_SESSION["user"]["email"] ?>><br><br>
        <input type="submit" value="Submit"><br><br>
    </form>

    <span>Mot de passe</span>
    <form method="post" action="change-password.php">
        <label for="form-old-password">Old password:</label><br>
        <input type="password" id="form-old-password" name="form-old-password"><br><br>
        <label for="form-password">New password:</label><br>
        <input type="password" id="form-password" name="form-password"><br><br>
        <label for="form-confirmPWD">Confirm password:</label><br>
        <input type="password" id="form-confirmPWD" name="form-confirmPWD"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>