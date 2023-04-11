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
// on a besoin du model :
require_once(__DIR__ . '/../../../helper/functions.php');


try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }

    $id_galleries = intval(filter_input(INPUT_GET, 'id_galleries', FILTER_SANITIZE_NUMBER_INT));
    $theGallery = Gallery::get($id_galleries);

    $types = Type::getAll();

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        // Nettoyer le name :
        if (isset($_POST['name'])) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            if (empty($name)) {
                $error['name'] = "Veuillez renseigner le nom de l'oeuvre.";
            } else {
                if (Gallery::existsName($name) === true && $name != $theGallery->name) {
                    $error['name'] = 'Ce nom est déjà existant.';
                } else {
                    if (empty($error)) {
                        $gallery = new Gallery();
                        // je lui donne les valeurs récupérées, nettoyées et validées :
                        $gallery->setName($name);
                        // Ajouter l'enregistrement du nouveau user à la base de données :
                        if ($gallery->updateName($id_galleries) === true) {
                            $message = 'Modification enregistrée!';
                        } else {
                            throw new Exception('Echec de l\'enregistrement.');
                        }
                    }
                }
            }
        }   

        // Nettoyer l'id_types :
        if (isset($_POST['id_types'])) {
            $id_types = intval(filter_input(INPUT_POST, 'id_types', FILTER_SANITIZE_NUMBER_INT));
            if (empty($id_types)) {
                $error['id_types'] = "Veuillez renseigner le type de l'oeuvre.";
            } else {
                if ($id_types != 1 && $id_types != 2) {
                    $error['id_types'] = 'Veuillez choisir l\'une des deux propositions du sélécteur.';
                } else {
                    if (empty($error)) {
                        $gallery = new Gallery();
                        // je lui donne les valeurs récupérées, nettoyées et validées :
                        $gallery->setId_types($id_galleries);
                        // Ajouter l'enregistrement du nouveau user à la base de données :
                        if ($gallery->updateId_types($id_gallerys) === true) {
                            // je sauvegarde l'image pour cela je supprime l'ancienne :
                            $oldPicture = __DIR__ . '/../../public/uploads/gallery/' . $theGallery->typeName . $id_galleries . '.png';
                            if (file_exists($oldPicture)) {
                                //sinon enlever la condition et mettre un @ devant unlink;
                                unlink($oldPicture);
                            }
                            $pictureName = $theGallery->typeName . '_' . $id_galleries . '.png';
                            $from = $oldPicture;
                            $to = LOCATION_UPLOAD . '/gallery/' . $pictureName;
                            move_uploaded_file($from, $to);
                            $message = 'Modification enregistrée!';
                        } else {
                            throw new Exception('Echec de l\'enregistrement.');
                        }
                    }
                }
            }
        }


        // Vérification de l'image :
        if (isset($_FILES['picture'])) {
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

                if (empty($error)) {

                    $oldPicture = __DIR__ . '/../../public/uploads/gallery/' . $theGallery->typeName . $id_galleries . '.png';
                    if (file_exists($oldPicture)) {
                        //sinon enlever la condition et mettre un @ devant unlink;
                        unlink($oldPicture);
                    }
                    $pictureName = $theGallery->typeName . '_' . $id_galleries . '.png';
                    $from = $_FILES['picture']['tmp_name'];
                    $to = LOCATION_UPLOAD . '/gallery/' . $pictureName;
                    move_uploaded_file($from, $to);

                    $message = 'Modification enregistrée!';
                }
            }
        }
        $theGallery = Gallery::get($id_galleries);
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/Gallery/getGallery.php');
include(__DIR__ . '/../../../views/templates/footer.php');
