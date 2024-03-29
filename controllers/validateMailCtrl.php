<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');


try {
    $id_users = intval(filter_input(INPUT_GET, 'id_users', FILTER_SANITIZE_NUMBER_INT));

    $validationIsOk = User::updateValidated_at($id_users);

    if ($validationIsOk) {
        $message = 'Mail validé, vous pouvez vous connecter.';
        Session::setMessage($message);
        header('location: /connexion.html');
        die;
    } else {
        $message = 'Pour vous connecter, valider votre email.';
        Session::setMessage($message);
        header('location: /accueil.html');
        die;
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
