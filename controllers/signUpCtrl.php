<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin d'accéder au tableau de messages :
require_once(__DIR__ . '/../config/config.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');

try {

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer l'email :
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        if (empty($email)) {
            $error['email'] = "Veuillez renseigner votre mail.";
        } else {
            // Valider l'email :
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "L'adresse e-mail n'est pas valide.";
            } else {
                if (User::existsEmail($email) === true) {
                    $alert['email'] = 'Email déjà existant.';
                }
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
                if (User::existsPseudo($pseudo) === true) {
                    $alert['pseudo'] = 'Pseudo déjà existant.';
                }
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
                    $password = password_hash($password, PASSWORD_DEFAULT);
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
                    $extUserAvatar = pathinfo($avatar, PATHINFO_EXTENSION);
                }
            }
        } else {
            $error['avatar'] = 'Fichier non renseigné.';
        }


        // Vérifier checkbox :
            $checkbox = filter_input(INPUT_POST, 'cGU', FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($checkbox)){
                $error['checkboxCgu'] = 'Vous devez accepter les Conditions Générales d\'Utilisation pour vous inscrire.';
            }



        if (empty($error)) {
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            // $validated_at = 'NOPE';
            $id_roles = 3;

            $user = new User();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setExtUserAvatar($extUserAvatar);
            $user->setCreated_at($created_at);
            $user->setUpdated_at($updated_at);
            // $user->setValidated_at($validated_at);
            $user->setId_roles($id_roles);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($user->add() === true) {
                $code = 12;
                $user = User::getByEmail($email);
                $avatarName = 'avatar_' . $user->id_users . '.' . $extUserAvatar;
                $from = $_FILES['avatar']['tmp_name'];
                $to = __DIR__ . '/../public/uploads/avatars/' . $avatarName;
                move_uploaded_file($from, $to);
                // setcookie('avatar', $to);
                header('location: /connection.html?code=' . $code);
                die;
            } else {
                $code = 14;
                header('location: /inscription.html?code=' . $code);
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/erreur.html');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/signUp.php');
include(__DIR__ . '/../views/templates/footer.php');
