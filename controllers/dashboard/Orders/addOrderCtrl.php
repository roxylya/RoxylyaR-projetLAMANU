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
require_once(__DIR__ . '/../../../models/Order.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Order.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Accessory.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Hairstyle.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Portrait.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Banner.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Outfit.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/OutfitAccessory.php');


try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_users = $user->id_users;
    $categories = Category::getAll();

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le name :
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($name)) {
            $error['name'] = "Veuillez renseigner le nom de l'oeuvre.";
        } else {
            if (Article::existsName($name) != false) {
                $error['name'] = 'Ce nom est déjà existant.';
            }
        }

        // Nettoyer l'id_catégories :

        $id_categories = intval(filter_input(INPUT_POST, 'id_categories', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_categories)) {
            $error['id_categories'] = "Veuillez renseigner le type de l'oeuvre.";
        } else {
            if ($id_categories != 1 && $id_categories != 2) {
                $error['id_categories'] = 'Veuillez choisir l\'une des deux propositions du sélécteur.';
            }
        }


        // Nettoyer le resume :
        $resume = trim(filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($resume)) {
            $error['resume'] = "Veuillez renseigner le nom de l'oeuvre.";
        } 


        // Vérification de l'image :
        if (!isset($_FILES['picture'])) {
            $error['picture'] = 'Une erreur est survenue.';
        } else {
            $picture = $_FILES['picture']['name'];
            $pictureType = $_FILES['picture']['type'];
            $pictureError = $_FILES['picture']['error'];

            if ($_FILES['picture']['error'] == 4) {
                $error['picture'] = 'L\'image est obligatoire';
            }

            if (!in_array($pictureType, EXTENSION_PNG)) {
                $error['picture'] = 'Les images acceptées sous le format png uniquement.';
            }

            if ($_FILES['picture']['size'] > MAX_FILESIZE_PICTURE) {
                $error['picture'] = 'Le poids de l\'image doit être inférieur à 2mo.';
            } else {
                $extUserpicture = pathinfo($picture, PATHINFO_EXTENSION);
            }
        }


        if (empty($error)) {
            $pdo = Database::getInstance();
            $pdo->beginTransaction();

            $article = new Article();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $article->setName($name);
            $article->setResume($resume);
            $article->setId_categories($id_categories);
            $article->setId_users($id_users);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($article->add() === true) {
                $id_articles = $pdo->lastInsertId();

                // je sauvegarde l'image :
                $article = Article::get($id_articles);

                $pictureName = $article->categoryName . '_' . $id_articles . '.' . $extUserpicture;

                $from = $_FILES['picture']['tmp_name'];
                $to = LOCATION_UPLOAD . '/catalog/' . $pictureName;
                move_uploaded_file($from, $to);
                if ($article != false) {
                    $pdo->commit();
                    $message = 'Nouvelle oeuvre ajoutée!';
                    Session::setMessage($message);
                    header('location: /admin-commandes.html');
                    die;
                } else {
                    $pdo->rollBack();
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

include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/Order/addOrder.php');
include(__DIR__ . '/../../../views/templates/footer.php');
