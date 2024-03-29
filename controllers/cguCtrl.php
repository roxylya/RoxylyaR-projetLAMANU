<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');



try {
    // si une session est en cours on la récupère :
    session_start();
    // on affiche l'header correspondant selon si user connecté ou non :
    if (!isset($_SESSION['id_users'])) {
        include(__DIR__ . '/../views/templates/header.php');
    } else {
        // on récupère l'id_users connecté:
        $id_users = $_SESSION['id_users'];
        // on récupère les informations de l'user connecté :
        $userConnected = User::getById($id_users);
        if ($userConnected->id_roles === 1 || $userConnected->id_roles === 2 || $userConnected->id_roles === 3) {
            include(__DIR__ . '/../views/templates/headerUserAccount.php');
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}

include(__DIR__ . '/../views/cgu.php');
include(__DIR__ . '/../views/templates/footer.php');
