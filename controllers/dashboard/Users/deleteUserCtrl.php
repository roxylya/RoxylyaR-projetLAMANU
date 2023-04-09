<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../../config/constants.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/User.php');


try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_users = intval(filter_input(INPUT_GET, 'id_users', FILTER_SANITIZE_NUMBER_INT));

    $theUser = User::delete($id_users);
    if ($theUser) {
        $message ='Le compte a bien été supprimé.';
        Session::setMessage($message);
    } else {
        $message = 'Une erreur est survenue. Le compte n\' a été supprimé.';
        Session::setMessage($message);
    }
    header('location: /admin.html');
    die;
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/dashboard.php');
include(__DIR__ . '/../../../views/templates/footer.php');
