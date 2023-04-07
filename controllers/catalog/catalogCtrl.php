<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../../models/User.php');
// on a besoin du model :
require_once(__DIR__ . '/../../models/Article.php');

try {
    // si une session est en cours on la récupère :
    session_start();
    // on affiche l'header correspondant selon si user connecté ou non :
    if (!isset($_SESSION['user'])) {
        include(__DIR__ . '/../../views/templates/header.php');
    } else {
        // on récupère l'id_users connecté:
        $user = $_SESSION['user'];
        // // on récupère les informations de l'user connecté :
        // $userConnected = User::getById($id_users);
        if ($user->id_roles === 1 || $user->id_roles === 2 || $user->id_roles === 3) {
            include(__DIR__ . '/../../views/templates/headerUserAccount.php');
        }
    }

    // Nettoyage et validation du formulaire reçu en post :
    $search = trim((string)filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    // pagination  
    // $limite= $limit (le nombre de patient à afficher par page) 
    $limit = 9;

    // je récupère le numéro de la page sur laquelle on se trouve
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($page)) {
        $page = 1;
    }

    // Calcul du 1er article de la page
    $firstArticle = ($page - 1) * $limit;


    // je limite l'affichage par page :
    $articles = Article::getAll($search, $firstArticle, $limit);

    // j'appelle ma méthode pour obtenir la liste des commentaires :
    $nbArticlesTotal = Article::getAllArticlesCount($search);

    // On calcule le nombre de pages 
    $pageNb = ceil(count($nbArticlesTotal) / $limit);
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}

include(__DIR__ . '/../../views/catalog/catalog.php');
include(__DIR__ . '/../../views/templates/footer.php');
