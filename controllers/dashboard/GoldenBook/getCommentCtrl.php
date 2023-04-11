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
    $id_comments = intval(filter_input(INPUT_GET, 'id_comments', FILTER_SANITIZE_NUMBER_INT));
    $theComment = Comment::get($id_comments);
    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Nettoyer le notice :
        if (isset($_POST['notice'])) {
            $notice = trim(filter_input(INPUT_POST, 'notice', FILTER_SANITIZE_SPECIAL_CHARS));
            if (empty($notice)) {
                $error['notice'] = "Veuillez renseigner le nom de l'oeuvre.";
            } else {
                if (empty($error)) {
                    $comment = new Comment();
                    // je lui donne les valeurs récupérées, nettoyées et validées :
                    $comment->setNotice($notice);
                    // Ajouter l'enregistrement du nouveau user à la base de données :
                    if ($comment->updateNotice($id_comments) === true) {
                        $message = 'Modification enregistrée!';
                    } else {
                        throw new Exception('Echec de l\'enregistrement.');
                    }
                }
            }
        }
    }

    $theComment = Comment::get($id_comments);
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}

include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/GoldenBook/getComment.php');
include(__DIR__ . '/../../../views/templates/footer.php');
