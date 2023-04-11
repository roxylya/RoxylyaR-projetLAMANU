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


    if (Comment::delete($id_comments)) {
        $message = 'Le commentaire a bien été supprimé.';
        Session::setMessage($message);
    } else {
        $message = 'Une erreur est survenue. L\'article n\' a été supprimé.';
        Session::setMessage($message);
    }
    header('location: /controllers/dashboard/Catalogs/getAllCatalogsCtrl.php');
    die;



} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/userAccount/GoldenBook/goldenBook.php');
include(__DIR__ . '/../../../views/templates/footer.php');
