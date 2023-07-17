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
     if(isset($_SESSION['user'])){
        $user =$_SESSION['user'];
        if (!$user->id_role === 1 || !$user->id_role === 2 || !$user->id_role === 3) {
            header('location: /logoutCtrl.php');
            die;
        }
     }
     // var_dump($user);
     // die;
     
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}

include(__DIR__ . '/../views/legalNotice.php');
include(__DIR__ . '/../views/templates/footer.php');
