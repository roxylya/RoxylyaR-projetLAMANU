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
// on a besoin du model :
require_once(__DIR__ . '/../../../models/Category.php');
// on a besoin du model :
require_once(__DIR__ . '/../../../helper/functions.php');

try {
    session_start();
    $user = $_SESSION['user'];
    if ($user->id_roles != 1) {
        header('location: /logOutCtrl.php');
    }
    $id_articles = intval(filter_input(INPUT_GET, 'id_articles', FILTER_SANITIZE_NUMBER_INT));
    $theArticle = Article::get($id_articles);

    $categories = Category::getAll();

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le name :
        if (isset($_POST['name'])) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            if (empty($name)) {
                $error['name'] = "Veuillez renseigner le nom de l'oeuvre.";
            } else {
                if (Article::existsName($name) === true && $name != $theArticle->name) {
                    $error['name'] = 'Ce nom est déjà existant.';
                } else {
                    if (empty($error)) {
                        $article = new Article();
                        // je lui donne les valeurs récupérées, nettoyées et validées :
                        $article->setName($name);
                        // Ajouter l'enregistrement du nouveau user à la base de données :
                        if ($article->updateName($id_articles) === true) {
                            $message = 'Modification enregistrée!';
                        } else {
                            throw new Exception('Echec de l\'enregistrement.');
                        }
                    }
                }
            }
        }


        // Nettoyer l'id_catégories :
        if (isset($_POST['id_categories'])) {
            $id_categories = intval(filter_input(INPUT_POST, 'id_categories', FILTER_SANITIZE_NUMBER_INT));
            if (empty($id_categories)) {
                $error['id_categories'] = "Veuillez renseigner la catégorie de l'article.";
            } else {
                if ($id_categories < 1 || $id_categories > 5) {
                    $error['id_categories'] = 'Veuillez choisir l\'une des propositions du sélécteur.';
                } else {
                    if (empty($error)) {
                        $article = new Article();
                        // je lui donne les valeurs récupérées, nettoyées et validées :
                        $article->setId_Categories($id_categories);
                        // Ajouter l'enregistrement du nouveau user à la base de données :
                        if ($article->updateId_categories($id_articles) === true) {
                            // je sauvegarde l'image pour cela je supprime l'ancienne :
                            $oldPicture = __DIR__ . '/../../public/uploads/catalog/' . $theArticle->categoryName . $id_articles . '.png';
                            if (file_exists($oldPicture)) {
                                //sinon enlever la condition et mettre un @ devant unlink;
                                unlink($oldPicture);
                            }
                            $pictureName = $theArticle->categoryName . '_' . $id_articles . '.png';
                            $from = $oldPicture;
                            $to = LOCATION_UPLOAD . '/catalog/' . $pictureName;
                            move_uploaded_file($from, $to);
                            $message = 'Modification enregistrée!';
                        } else {
                            throw new Exception('Echec de l\'enregistrement.');
                        }
                    }
                }
            }
        }



        // Nettoyer le resume :
        if (isset($_POST['resume'])) {
            $resume = trim(filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_SPECIAL_CHARS));
            if (empty($resume)) {
                $error['resume'] = "Veuillez renseigner le nom de l'oeuvre.";
            } else {
                if (empty($error)) {
                    $article = new Article();
                    // je lui donne les valeurs récupérées, nettoyées et validées :
                    $article->setResume($resume);
                    // Ajouter l'enregistrement du nouveau user à la base de données :
                    if ($article->updateResume($id_articles) === true) {
                        $message = 'Modification enregistrée!';
                    } else {
                        throw new Exception('Echec de l\'enregistrement.');
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

                    $oldPicture = __DIR__ . '/../../public/uploads/catalog/' . $theArticle->categoryName . $id_articles . '.png';
                    if (file_exists($oldPicture)) {
                        //sinon enlever la condition et mettre un @ devant unlink;
                        unlink($oldPicture);
                    }
                    $pictureName = $theArticle->categoryName . '_' . $id_articles . '.png';
                    $from = $_FILES['picture']['tmp_name'];
                    $to = LOCATION_UPLOAD . '/catalog/' . $pictureName;
                    move_uploaded_file($from, $to);

                    $message = 'Modification enregistrée!';
                }
            }
        }
         $theArticle = Article::get($id_articles);
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
include(__DIR__ . '/../../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../../views/dashboard/Catalog/getCatalog.php');
include(__DIR__ . '/../../../views/templates/footer.php');
