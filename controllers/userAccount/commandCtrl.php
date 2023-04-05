<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/dd.php');
// on a besoin du models :
require_once(__DIR__ . '/../../models/User.php');

try {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: /accueil.html');
        die;
    } else {
        $user = $_SESSION['user'];
        // $userConnected = User::getById($id_users);
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/command.php');
include(__DIR__ . '/../../views/templates/footer.php');
