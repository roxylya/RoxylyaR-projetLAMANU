<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/dd.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../../helper/functions.php');
// on a besoin du models :
require_once(__DIR__ . '/../../models/User.php');

try {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: /accueil.html');
        die;
    } else {
        $user = $_SESSION['user'];
        $id_users = $user->id_users;
    }
    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (isset($_POST['email'])) {
            // Nettoyer le mail :
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

            // Valider le mail :
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'L\'adresse e-mail n\'est pas valide.';
            } else {
                if (User::existsEmail($email) === true && $email != $user->email) {
                    // si le mail existe j'ajoute le message d'erreur au tableau d'error :
                    $error['Email'] = 'Email déjà existant.';
                } else {
                    $userUpdate = new User();
                    // je lui donne les valeurs récupérées, nettoyées et validées :
                    $userUpdate->setEmail($email);
                    // Modifier les informations de l'user en fonction de son id sur la base de données :
                    if ($userUpdate->updateEmail($id_users) === true) {
                     
                        // mail de validation :
                        $link = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/controllers/validateMailCtrl.php?id_users=' . $user->id_users;
                        $for = $user->email;
                        $subject = 'Confirmer votre changement d\'email sur Roxylya R';
                        $text = 'Bonjour, <br>Afin de valider le changement de votre email, merci de cliquer sur ce <a href="' . $link . '">lien</a>.';
                        mail($for, $subject, $text);

                        $message = 'Votre changement d\'email a été enregistré. Validez-le en cliquant sur le lien reçu sur votre messagerie.';
                        Session::setMessage($message);
                        header('location /connexion.html');

                    }
                }
            }
        }

        if (isset($_POST['pseudo'])) {

            // Nettoyer le pseudo :
            $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS));

            // Pseudo correspond à la regex ?
            if (!filter_var($pseudo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PSEUDO . '/')))) {
                $error['pseudo'] = 'Format incorrect.';
            } else {
                if (User::existsPseudo($pseudo) === true && $pseudo != $user->pseudo) {
                    // si le pseudo existe j'ajoute le message d'erreur au tableau d'error :
                    $error['pseudo'] = 'Pseudo utilisé par un autre utilisateur.';
                } else {
                    $userUpdate = new User();
                    // je lui donne les valeurs récupérées, nettoyées et validées :
                    $userUpdate->setPseudo($pseudo);
                    // Modifier les informations de l'user en fonction de son id sur la base de données :
                    if ($userUpdate->updatePseudo($id_users) === true) {
                        $message = 'Le changement de votre pseudo a été enregistré.';
                        Session::setMessage($message);
                        Session::getMessage();
                    }
                }
            }
        }

        if (isset($_POST['password'])) {

            // Récupérer les mots de passe :
            $password =  $_POST['password'];
            $passwordConfirm =  $_POST['passwordConfirm'];
            if (empty($password) && empty($passwordConfirm)) {
                $error['password'] = 'Veuillez entrer un mot de passe.';
            } else {

                // Mots de passe identiques ?
                if ($password != $passwordConfirm) {
                    $error['password'] = 'Les mots de passe doivent être identiques.';
                } else {
                    // Mot de passe correspond à la regex ?
                    if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/'))) || !filter_var($passwordConfirm, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
                        $error['password'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
                    } else {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $userUpdate = new User();
                        // je lui donne les valeurs récupérées, nettoyées et validées :
                        $userUpdate->setPassword($password);

                        // Modifier les informations de l'user en fonction de son id sur la base de données :
                        if ($userUpdate->updatePassword($id_users) === true) {
                            $message = 'Le changement de votre mot de passe a été enregistré.';
                            Session::setMessage($message);
                            Session::getMessage();
                        }
                    }
                }
            }
        }

        // Vérification de l'image :
        if (isset($_FILES['avatar'])) {
            $avatar = $_FILES['avatar']['name'];
            $avatarType = $_FILES['avatar']['type'];
            $avatarError = $_FILES['avatar']['error'];

            if (!empty($avatar)) {
                if (!in_array($avatarType, EXTENSION)) {
                    $error['avatar'] = 'Le fichier envoyé n\'est pas valide.';
                } else {
                    $oldAvatar = __DIR__ . '/../../public/uploads/avatars/avatar_' . $user->id_users . '.' . $user->extUserAvatar;
                    if (file_exists($oldAvatar)) {
                        //sinon enlever la condition et mettre un @ devant unlink;
                        unlink($oldAvatar);
                    }
                    $extUserAvatar = pathinfo($avatar, PATHINFO_EXTENSION);
                    $userUpdate = new User();
                    // je lui donne les valeurs récupérées, nettoyées et validées :
                    $userUpdate->setExtUserAvatar($extUserAvatar);
                    // Modifier les informations de l'user en fonction de son id sur la base de données :
                    if ($userUpdate->updateExtUserAvatar($id_users) === true) {
                        $message = 'Le changement de votre avatar a été enregistré.';
                        Session::setMessage($message);
                        Session::getMessage();
                        $avatarName = 'avatar_' . $user->id_users . '.' . $extUserAvatar;
                        $from = $_FILES['avatar']['tmp_name'];
                        $to = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        move_uploaded_file($from, $to);



                        // définition des points de référence image en portrait ou en paysage :
                        $size = 200;
                        $width_original = getWidthOriginal($to);
                        $height_original = getHeightOriginal($to);
                        if (isPortrait($to) === true && $width_original > 200) {
                            $width_scaled = $size;
                            $height_scaled = -1;

                            if ($avatarType == 'image/png') {
                                $gd_original = imagecreatefrompng($to);
                                $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                                $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                                imagepng($gd_scaled, $to_scaled);
                            } elseif ($avatarType == 'image/jpeg') {
                                $gd_original = imagecreatefromjpeg($to);
                                $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                                $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                                imagejpeg($gd_scaled, $to_scaled, 90);
                            } else {
                                $message = "Une erreur est survenue. Essayez encore.";
                                Session::setMessage($message);
                                header('location: /erreur.html');
                                die;
                            }
                        }
                        if (isPortrait($to) === false && $height_original > 200) {
                            $height_scaled = $size;
                            $width_scaled = intval(($width_original / $height_original) * $height_scaled);

                            //  je redimensionne l'image à 200px de large max :  
                            if ($avatarType == 'image/png') {
                                $gd_original = imagecreatefrompng($to);
                                $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                                $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                                imagepng($gd_scaled, $to_scaled);
                            } elseif ($avatarType == 'image/jpeg') {
                                $gd_original = imagecreatefromjpeg($to);
                                $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                                $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                                imagejpeg($gd_scaled, $to_scaled, 90);
                            } else {
                                $message = "Une erreur est survenue. Essayez encore.";
                                Session::setMessage($message);
                                header('location: /erreur.html');
                                die;
                            }
                        }
                        $_SESSION['user']=User::getById($id_users);
                        $user = $_SESSION['user'];
                    }
                }
            } else {
                $message = 'La modification n\'a pu être effectuée.';
                Session::setMessage($message);
                Session::getMessage();
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


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/profilAccount.php');
include(__DIR__ . '/../../views/templates/footer.php');
