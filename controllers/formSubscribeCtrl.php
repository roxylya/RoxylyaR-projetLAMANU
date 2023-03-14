<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du model User :
require_once(__DIR__ . '/../models/User.php');

// je teste si mon code fonctionne :
try {

    // je crée un tableau où se trouveront tous les messages d'erreur :
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
            } else {
                setcookie('Email', $email);
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
            } else {
                setcookie('Pseudo', $pseudo);
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
                    setcookie('password', $password);
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
                } 
                // else {
                //     $extension = pathinfo($avatar, PATHINFO_EXTENSION);
                //     $avatarName = 'avatar_' . $pseudo . '.' . $extension;
                //     $from = $_FILES['avatar']['tmp_name'];
                //     $to = __DIR__ . '/../public/uploads/avatars/' . $avatarName;
                //     move_uploaded_file($from, $to);
                //     setcookie('Avatar', $to);
                // }
            }
        } else {
            $error['avatar'] = 'Fichier non renseigné.';
        }

        if (empty($error)) {
            $user = new User();
            $created_at = date('d-m-Y');
            $updated_at = date('d-m-Y');
            $validated_at = 'NOPE';
            $id_roles = 3;
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setCreated_at($created_at);
            $user->setUpdated_at($updated_at);
            $user->setValidated_at($validated_at);
            $user->setId_roles($id_roles);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($user->add() === true) {
                $code = 12;
                $extension = pathinfo($avatar, PATHINFO_EXTENSION);
                $avatarName = 'avatar_' . $pseudo . '.' . $extension;
                $from = $_FILES['avatar']['tmp_name'];
                $to = __DIR__ . '/../public/uploads/avatars/' . $avatarName;
                move_uploaded_file($from, $to);
                // setcookie('Avatar', $to);
                header('location: /controllers/connexionCtrl.php?code=' . $code);
                die;
            }else {
                $code= 13;
                header('location: /controllers/formSubscribeCtrl.php?code=' . $code);
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/formSubscribe.php');
include(__DIR__ . '/../views/templates/footer.php');
