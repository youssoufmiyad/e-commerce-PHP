<?php
session_start();

require_once("../../utils/connect.php");
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Récupération du mot de passe actuel
    $old_password = $db->query(
        "SELECT Passwd FROM users WHERE UserId=" . $_SESSION['user']['userId']
    )->fetch_assoc();
    $old_password = $old_password["Passwd"];

    // Vérification du remplissage des champs coté serveur
    if (isset($_POST['form-old-password']) && isset($_POST['form-password']) && isset($_POST['form-confirmPWD'])) {

        $old_password_confirm = $_POST['form-old-password'];
        $new_password = $_POST['form-password'];
        $confirm_password = $_POST['form-confirmPWD'];

        if (password_verify($old_password_confirm, $old_password)) {

            if ($new_password === $confirm_password) {
                // Requête de modification du produit existant à la base de données
                $postQuery = $db->prepare("UPDATE `users` SET `Passwd`=? WHERE `UserId`=?;");
                $postQuery->bind_param("si", password_hash($new_password, PASSWORD_DEFAULT), $_SESSION['user']['userId']);
                try {
                    $postQuery->execute();
                    header("location: ../");
                } catch (\Throwable $th) {
                    throw $th;
                }
            }else{
                echo "les mdp ne correspondent pas";
            }
        }else{
            echo "mot de passe incorrect";
        }

    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>