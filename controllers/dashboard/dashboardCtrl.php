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
    session_start();
    $user = $_SESSION['user'];
    if($user->id_roles != 2 || $user->id_roles != 3){
        header('location: /accueil.html'); 
    }
    // $userConnected = User::getById($id_users);
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../erreur.html');
    die;
}


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/dashboard/dashboard.php');
include(__DIR__ . '/../../views/templates/footer.php');
