<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/config.php');
// on a besoin du models :
require_once(__DIR__ . '/../../models/User.php');


try {
    session_start();
    $id_users = $_SESSION['id_users'];
    $userConnected = User::getById($id_users);
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../controllers/errorCtrl.php');
    die;
}

include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/ordersUser.php');
include(__DIR__ . '/../../views/templates/footer.php');