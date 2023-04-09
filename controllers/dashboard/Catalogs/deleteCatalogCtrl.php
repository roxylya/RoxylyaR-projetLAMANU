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
require_once(__DIR__ . '/../../../models/Article.php');


try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_articles = intval(filter_input(INPUT_GET, 'id_articles', FILTER_SANITIZE_NUMBER_INT));

    $theArticle = Article::get($id_articles);

    $oldPicture = __DIR__ . '/../../public/uploads/catalog/' . $theArticle->categoryName . '_' . $id_articles . '.png';
    if (file_exists($oldPicture)) {
        //sinon enlever la condition et mettre un @ devant unlink;
        unlink($oldPicture);
    }
    if (Article::delete($id_articles)) {
        $message = 'L\'article a bien été supprimé.';
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
include(__DIR__ . '/../../../views/dashboard/Catalog/catalog.php');
include(__DIR__ . '/../../../views/templates/footer.php');
