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
     // si une session est en cours on la récupère :
     session_start();
     // on affiche l'header correspondant selon si user connecté ou non :
     if (!isset($_SESSION['user'])) {
         include(__DIR__ . '/../../../views/templates/header.php');
     } else {
         // on récupère l'id_users connecté:
         $user = $_SESSION['user'];
         // // on récupère les informations de l'user connecté :
         // $userConnected = User::getById($id_users);
         if ($user->id_roles === 1 || $user->id_roles === 2 || $user->id_roles === 3) {
             include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
         }
     }
     if ($user->id_roles != 2 && $user->id_roles != 1) {
         header('location: /../../controllers/logOutCtrl.php');
         die;
     } else {
        $id_users = $user->id_users;
         $commentsUser = Comment::get($id_users);
     }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
  }

include(__DIR__ . '/../../../views/dashboard/goldenBook.php');
include(__DIR__ . '/../../../views/templates/footer.php');
