<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete user</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../../utils/connect.php');

?>
<?php
// Envoi du formulaire de supression d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage du champ "user-id" coté serveur
    if (isset($_POST['user-id'])) {
        $id = $_POST['user-id'];
        // Requête d'insert du produit à la base de données
        $db->query("DELETE FROM `users_photo` WHERE `UserId`=$id;");
        $db->query("DELETE FROM `users` WHERE `UserId`=$id;");

        try {
            echo "Utilisateur supprimé avec succès !";
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
        $utilisateurs = $db->query('SELECT * FROM users');
        if ($utilisateurs->num_rows > 0) {
            foreach ($utilisateurs as $utilisateur) {
                $image = $db->query("SELECT Image FROM users_photo WHERE UserId=" . $utilisateur["UserId"] . ";");
                $image = $image->fetch_assoc();
                $base64img = @base64_encode($image["Image"]);
                $src = "data:file/png;base64," . $base64img;
                ?>
                <tr>
                    <td>
                        <?= $utilisateur['UserId'] ?>
                    </td>
                    <td>
                        <img src="<?php echo $src ?>" height="32px" width="32px" />
                    </td>
                    <td>
                        <?= $utilisateur['LastName'] ?>
                    </td>
                    <td>
                        <?= $utilisateur['FirstName'] ?>
                    </td>
                    <td>
                        <?= $utilisateur['Email'] ?>
                    </td>
                    <td>
                        <?= $utilisateur['Passwd'] ?>
                    </td>
                </tr>
                <br>
                <?php
            }
        } ?>
        <form method="post">
            <label for="user-id">Identifiant du produit :</label>
            <input type="number" name="user-id" id="user-id" placeholder="entrez un id">
            <br>


            <button>supprimer</button>
        </form>
    </div>
</body>

</html>