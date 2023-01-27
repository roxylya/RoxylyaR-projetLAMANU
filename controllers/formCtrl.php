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

    // Nettoyer le pseudo :
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($pseudo)) {
        $error['pseudo'] = 'Veuillez entrer votre pseudo RR.';
    } else {
        // Pseudo correspond à la regex ?
        if (!filter_var($pseudo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PSEUDO . '/')))) {
            $error['pseudo'] = 'Format incorrect.';
        }
    }

    // Récupérer les mots de passe :
    $password =  $_POST['password'];
    $passwordConfirm =  $_POST['passwordConfirm'];
    if (empty($password) && empty($passwordConfirm)) {
        $error['password'] = 'Veuillez entrer un mot de passe.';
    } else {

        // Mots de passe identiques ?
        if ($password != $passwordConfirm) {
            $error['password'] = 'Les mots de passe doivent être identiques.';
        } else {
            // Mot de passe correspond à la regex ?
            if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/'))) || !filter_var($passwordConfirm, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
                $error['password'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            }
        }
    }

    // Vérification de l'image :
    if (isset($_FILES['avatar'])) {
        $avatar = $_FILES['avatar']['name'];
        $avatarType = $_FILES['avatar']['type'];
        $avatarError = $_FILES['avatar']['error'];

        if (empty($avatar)) {
            $error['avatar'] = 'Une erreur est survenue.';
        } else {
            if (!in_array($avatarType, EXTENSION)) {
                $error['avatar'] = 'Le fichier envoyé n\'est pas valide.';
            } else {
                $extension = pathinfo($avatar, PATHINFO_EXTENSION);
                $avatarName = 'avatar.' . $extension;
                $from = $_FILES['avatar']['tmp_name'];
                $to = __DIR__ . '/../public/uploads/avatar/' . $avatarName;
                move_uploaded_file($from, $to);
            }
        }
    } else {
        $error['avatar'] = 'Fichier non renseigné.';
    }
}












if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($error)) {
    header('location: /controllers/userAccountCtrl.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/form.php');
include(__DIR__ . '/../views/templates/footer.php');
