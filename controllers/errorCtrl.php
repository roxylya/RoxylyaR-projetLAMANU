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
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// on affiche l'header correspondant selon si user connecté ou non :
if (!isset($_SESSION['user'])) {
    include(__DIR__ . '/../views/templates/header.php');
} else {
    // on récupère l'id_users connecté:
    $user = $_SESSION['user'];
    // on récupère les informations de l'user connecté :
    if ($user->id_roles === 1 || $user->id_roles === 2 || $user->id_roles === 3) {
        include(__DIR__ . '/../views/templates/headerUserAccount.php');
    }
}

// si une session est en cours on la récupère :
$message = Session::getMessage();


include(__DIR__ . '/../views/error.php');
include(__DIR__ . '/../views/templates/footer.php');
