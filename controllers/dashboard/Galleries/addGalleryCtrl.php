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
require_once(__DIR__ . '/../../../models/Gallery.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Type.php');



try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_users = $user->id_users;
    $types= Type::getAll();

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le name :
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($name)) {
            $error['name'] = "Veuillez renseigner le nom de l'oeuvre.";
        } else {
            if (Gallery::existsName($name) === true) {
                $alert['name'] = 'Ce nom est déjà existant.';
            }
        }


        $id_types = trim(filter_input(INPUT_POST, 'id_types', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_types)) {
            $error['id_types'] = "Veuillez renseigner le type de l'oeuvre.";
        } else {
            if ($id_types != 1 && $id_types != 2) {
                $alert['id_types'] = 'Veuillez choisir l\'une des deux propositions du sélécteur.';
            } 
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
            $gallery = new Gallery();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $gallery->setName($name);
            $gallery->setId_types($id_types);
            $gallery->setId_users($id_users);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($gallery->add() === true) {

                // je sauvegarde l'picture :
                $picture = Gallery::getByName($name);
                    $pictureName = $picture->typeName . '_' . $picture->id_galleries . '.' . $extUserpicture;
                    $from = $_FILES['picture']['tmp_name'];
                    $type = $_FILES['picture']['type'];
                    $to = LOCATION_UPLOAD . '/gallery/' . $pictureName;

                move_uploaded_file($from, $to);
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
include(__DIR__ . '/../../../views/dashboard/Gallery/addGallery.php');
include(__DIR__ . '/../../../views/templates/footer.php');
