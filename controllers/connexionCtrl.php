<?php

require(__DIR__ . '/../config/constants.php');
$error = [];

// Vérifier les données envoyées :
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Nettoyer le mail :
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    if (empty($email)) {
        $error['email'] = "Veuillez renseigner votre mail.";
    } else {
        // Valider le mail :
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "L'adresse e-mail n'est pas valide.";
        }
    }


    // Récupérer les mots de passe :
    $password =  $_POST['password'];
    if (empty($password)) {
        $error['password'] = 'Veuillez entrer votre mot de passe.';
    } else {

        // Mot de passe correspond à la regex ?
        if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/'))) || !filter_var($passwordConfirm, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
            $error['password'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    if (empty($error)) {
        header('location: /controllers/userAccountCtrl.php');
        die;
    }
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/connexion.php');
include(__DIR__ . '/../views/templates/footer.php');
