<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../../models/User.php');


try {

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // récupération de l'id_users compris dans le lien :
    $id_users = intval(filter_input(INPUT_GET, 'id_users', FILTER_SANITIZE_NUMBER_INT));

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        if (empty($error)) {
            $updated_at = date('Y-m-d H:i:s');
            $user = new User();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $user->setPassword($password);
            $user->setUpdated_at($updated_at);
            // Modifier les informations de l'user en fonction de son id sur la base de données :
            if ($user->updatePassword($id_users) === true) {
                $message = 'Votre nouveau mot de passe a bien été enregistré. Vous pouvez vous connecter.';
                Session::setMessage($message);
                header('location: /connexion.html');
                die;
            } else {
                $message = 'Une erreure est survenue, reformulez votre demande.';
                Session::setMessage($message);
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}


include(__DIR__ . '/../../views/templates/header.php');
include(__DIR__ . '/../../views/forgetPassword/formChangePassword.php');
include(__DIR__ . '/../../views/templates/footer.php');
