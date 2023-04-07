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
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Comment.php');




try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_users = $user->id_users;

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

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
                header('location: /controllers/dashboard/GoldenBook/getAllCommentsCtrl.php');
                die;
            } else {
                throw new Exception('Echec de l\'enregistrement.');
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

include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/GoldenBook/addComment.php');
include(__DIR__ . '/../../../views/templates/footer.php');
