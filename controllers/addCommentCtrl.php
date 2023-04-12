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
require_once(__DIR__ . '/../models/Comment.php');



try {
    // si une session est en cours on la récupère :
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $id_users = $user->id_users;
        // Vérifier les données envoyées :
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Nettoyer le notice :
            $notice = trim(filter_input(INPUT_POST, 'notice', FILTER_SANITIZE_SPECIAL_CHARS));
            if (empty($notice)) {
                $error['notice'] = "Veuillez renseigner le champ avant de l'envoyer.";
            } else {
                if (strlen($notice) > 300) {
                    $error['notice'] = "Le nombre de caractères maximum est de 300.";
                }
            }

            if (empty($error)) {

                $comment = new Comment();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $comment->setNotice($notice);
                $comment->setId_users($id_users);
                // Ajouter l'enregistrement du nouveau user à la base de données :
                if ($comment->add() === true) {
                    $message = 'Nouvelle oeuvre ajoutée!';
                    Session::setMessage($message);
                    header('location: /livre-d-or.html');
                    die;
                } else {
                    throw new Exception('Echec de l\'enregistrement.');
                }
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}

if (!isset($_SESSION['user'])) {
    include(__DIR__ . '/../views/templates/header.php');
} else {
    // on récupère l'id_users connecté:
    $user = $_SESSION['user'];
    // // on récupère les informations de l'user connecté :
    // $userConnected = User::getById($id_users);
    if ($user->id_roles === 1 || $user->id_roles === 2 || $user->id_roles === 3) {
        include(__DIR__ . '/../views/templates/headerUserAccount.php');
    }
}
include(__DIR__ . '/../views/addComment.php');
include(__DIR__ . '/../views/templates/footer.php');
