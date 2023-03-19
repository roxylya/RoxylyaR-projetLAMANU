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
    // on récupère le message d'erreur :
    $errorMessage = $th->getMessage();
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
    // on affiche la page d'erreur
    include(__DIR__ . '/../controllers/errorCtrl.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}

include(__DIR__ . '/../views/gallery.php');
include(__DIR__ . '/../views/templates/footer.php');
