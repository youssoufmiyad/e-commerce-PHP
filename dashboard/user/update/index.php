<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update user</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../../../utils/connect.php');

?>
<?php
// Envoi du formulaire de création d'un utilisate$utilisateur
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Vérification du remplissage des champs coté serveur
    if (!empty($_POST['form-email']) && !empty($_POST['form-password']) && !empty($_POST['user-id']) && !empty($_POST['form-firstname']) && !empty($_POST['form-lastname'])) {
        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];
        $password = password_hash($_POST['form-password'], PASSWORD_DEFAULT);
        $id = $_POST['user-id'];

        $utilisateurs = $db->query('SELECT * FROM users WHERE UserId=' . $id . ';')->fetch_assoc();

        // Requête de modification du utilisate$utilisateur existant à la base de données
        $postQuery = $db->prepare("UPDATE `users` SET `LastName`=?, `FirstName`=?, `Email`=?, `Passwd`=? WHERE `UserId`=?;");
        $postQuery->bind_param("ssssi", $lastname, $firstname, $email, $password, $id);

        try {
            $postQuery->execute();
            echo "utilisateur modifié avec succès !";
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>

<body>
    <div class="navbar">
        <ul>
            <li><a href="../create">Enregistrer un nouveau utilisate$utilisateur</a></li>
            <li><a href="../">Voir les utilisate$utilisateur</a></li>
            <li><a href="./">Modifier un utilisate$utilisateur existant</a></li>
            <li><a href="../delete">Supprimer un utilisate$utilisateur</a></li>
        </ul>
    </div>
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
    <div>
        <span>Modification d'un utilisateur</span>
        <form method="post">
            <label for="user-id">Identifiant de l'utilisateur :</label>
            <input type="number" name="user-id" id="user-id" value="<?= $result['UserId'] ?>"
                placeholder="entrez un id">
            <br>

            <label for="form-lastname">Nom du utilisateur :</label>
            <input type="text" name="form-lastname" id="form-lastname" value="<?= $result['LastName'] ?>"
                placeholder="entrez un nom">
            <br>

            <label for="form-firstname">Prénom de l'utilisateur :</label>
            <input type="text" name="form-firstname" id="form-firstname" value="<?= $result['FirstName'] ?>"
                placeholder="entrez un prix">
            <br>

            <label for="form-email">Email :</label>
            <input type="text" name="form-email" id="form-email" value="<?= $result['Email'] ?>"
                placeholder="entrez un form-email">
            <br>

            <label for="form-password">Mot de passe :</label>
            <input type="text" name="form-password" id="form-password" value="<?= $result['Passwd'] ?>"
                placeholder="entrez le mot de passe">
            <br>

            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="999999999999">
            <label for="user-image">Image</label>
            <input type="file" name="user-image" id="user-image" accept="image/png, image/gif, image/jpeg"><br> -->


            <button>MODIFIER</button>
        </form>
    </div>
</body>

</html>