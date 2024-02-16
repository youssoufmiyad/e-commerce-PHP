<?php
session_start();

require_once("../../utils/connect.php");
// Envoi du formulaire de création d'un produit
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Vérification du remplissage des champs coté serveur
    if (isset($_POST['form-lastname']) && isset($_POST['form-firstname']) && isset($_POST['form-email'])) {

        $lastname = $_POST['form-lastname'];
        $firstname = $_POST['form-firstname'];
        $email = $_POST['form-email'];

        // Requête de modification du produit existant à la base de données
        $postQuery = $db->prepare("UPDATE `users` SET `Lastname`=?, `Firstname`=?, `Email`=? WHERE `UserId`=?;");
        $postQuery->bind_param("sssi", $lastname, $firstname, $email, $_SESSION['user']['userId']);
        try {
            $postQuery->execute();
            $_SESSION['user']['lastName'] = $lastname;
            $_SESSION['user']['firstName'] = $firstname;
            $_SESSION['user']['email'] = $email;
            header("location: ../");
        } catch (\Throwable $th) {
            throw $th;
        }
    } else {
        throw new Exception("form incomplet", 1);

    }
}

?>