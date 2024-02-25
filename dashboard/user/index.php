<!DOCTYPE html>
<html lang="en">

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
            <li><a href="./create">Enregistrer un nouveau utilisateur</a></li>
            <li><a href="./">Voir les utilisateurs</a></li>
            <li><a href="./update">Modifier un utilisateur existant</a></li>
            <li><a href="./delete">Supprimer un utilisateur</a></li>
        </ul>
    </div>

    <?php
    // Requête de selection des utilisateur à la base de données
    $result = $db->query('SELECT * FROM users');
    if ($result->num_rows > 0) {
        foreach ($result as $utilisateur) {
            ?>
            <tr>
                <td>
                    <?= $utilisateur['UserId'] ?>
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
                <td>
                    <?= $utilisateur['Enabled'] ?>
                </td>
            </tr>
            <br>
            <?php
        }
    }
    ?>
</body>

</html>