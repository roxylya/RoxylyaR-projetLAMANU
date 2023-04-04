<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin d'accéder au tableau de messages :
require_once(__DIR__ . '/../../config/config.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../../models/User.php');

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
                if (User::existsEmail($email) === false) {
                    $alert['email'] = 'L\'email ne correspond à aucun compte utilisateur.';
                }
            }
        }

        if (empty($error)) {
            $user = User::getByEmail($email);
            // envoyer un lien sur le mail communiqué qui redirigera vers formChangePassword

            // à faire mail
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
include(__DIR__ . '/../../views/forgetPassword/formForgetPassword.php');
include(__DIR__ . '/../../views/templates/footer.php');
