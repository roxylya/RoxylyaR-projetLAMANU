<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/config.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/User.php');


try {
    session_start();
    if (!isset($_SESSION['id_users'])) {
        include(__DIR__ . '/../views/templates/header.php');
    } else {
        $id_users = $_SESSION['id_users'];
        $userConnected = User::getById($id_users);
        if ($userConnected->id_roles === 3) {
            include(__DIR__ . '/../views/templates/headerUserAccount.php');
        } 
        if($userConnected->id_roles === 2 || $userConnected->id_roles === 1 ) {
            include(__DIR__ . '/../views/templates/headerDashboard.php');
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    if (!isset($_SESSION['id_users'])) {
        include(__DIR__ . '/../views/templates/header.php');
    } else {
        $id_users = $_SESSION['id_users'];
        $userConnected = User::getById($id_users);
        if ($userConnected->id_roles === 3) {
            include(__DIR__ . '/../views/templates/headerUserAccount.php');
        } 
        if($userConnected->id_roles === 2 || $userConnected->id_roles === 1 ) {
            include(__DIR__ . '/../views/templates/headerDashboard.php');
        }
    }
    include(__DIR__ . '/../controllers/errorCtrl.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}

include(__DIR__ . '/../views/catalog.php');
include(__DIR__ . '/../views/templates/footer.php');
