<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin d'accéder aux fonctions :
require_once(__DIR__ . '/../helper/functions.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');

try {

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer l'email :
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        if (empty($email)) {
            $error['email'] = "Veuillez renseigner votre mail.";
        } else {
            // Valider l'email :
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "L'adresse e-mail n'est pas valide.";
            } else {
                if (User::existsEmail($email) === true) {
                    $alert['email'] = 'Email déjà existant.';
                }
            }
        }


        // Nettoyer le pseudo :
        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($pseudo)) {
            $error['pseudo'] = 'Veuillez entrer votre pseudo RR.';
        } else {
            // Pseudo correspond à la regex ?
            if (!filter_var($pseudo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PSEUDO . '/')))) {
                $error['pseudo'] = 'Format incorrect.';
            } else {
                if (User::existsPseudo($pseudo) === true) {
                    $alert['pseudo'] = 'Pseudo déjà existant.';
                }
            }
        }

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
                }
            }
        }

        // Vérification de l'image :
        if (!isset($_FILES['avatar'])) {
            $error['avatar'] = 'Une erreur est survenue.';
        } else {
            $avatar = $_FILES['avatar']['name'];
            $avatarType = $_FILES['avatar']['type'];
            $avatarError = $_FILES['avatar']['error'];

            if ($_FILES['avatar']['error'] == 4) {
                $error['avatar'] = 'L\'image est obligatoire';
            }

            if (!in_array($avatarType, EXTENSION)) {
                $error['avatar'] = 'Les images acceptées : .png, jpg, jepg.';
            }

            if ($_FILES['avatar']['size'] > MAX_FILESIZE) {
                $error['avatar'] = 'Le poids de l\'image doit être inférieur à 5mo.';
            } else {
                $extUserAvatar = pathinfo($avatar, PATHINFO_EXTENSION);
            }
        }


        // Vérifier checkbox :
        $checkbox = filter_input(INPUT_POST, 'cGU', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($checkbox)) {
            $error['checkboxCgu'] = 'Vous devez accepter les Conditions Générales d\'Utilisation pour vous inscrire.';
        }

        if (empty($error)) {
            $id_roles = 3;

            $user = new User();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setExtUserAvatar($extUserAvatar);
            $user->setId_roles($id_roles);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($user->add() === true) {

                // je sauvegarde l'avatar :
                $user = User::getByEmail($email);
                $avatarName = 'avatar_' . $user->id_users . '.' . $extUserAvatar;
                $from = $_FILES['avatar']['tmp_name'];
                $type = $_FILES['avatar']['type'];
                $to = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                move_uploaded_file($from, $to);


                // mail de validation :
                $link = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/controllers/validateMailCtrl.php?id_users=' . $user->id_users;
                $for = $user->email;
                $subject = 'Validation de votre inscription sur Roxylya R';
                $text = 'Bonjour, <br>Afin de valider votre inscription sur le site Roxylya R, merci de cliquer sur ce <a href="' . $link . '">lien</a>.';
                mail($for, $subject, $text);

                // redirection vers la page de connexion :
                $message = 'Votre compte a été enregistré, validez votre mail pour pouvoir vous connecter.';
                Session::setMessage($message);


                // définition des points de référence image en portrait ou en paysage :
                $size = 200;
                $width_original = getWidthOriginal($to);
                $height_original = getHeightOriginal($to);
                if (isPortrait($to) === true && $width_original > 200) {
                    $width_scaled = $size;
                    $height_scaled = -1;

                    if ($type == 'image/png') {
                        $gd_original = imagecreatefrompng($to);
                        $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                        $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        imagepng($gd_scaled, $to_scaled);
                    } elseif ($type == 'image/jpeg') {
                        $gd_original = imagecreatefromjpeg($to);
                        $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                        $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        imagejpeg($gd_scaled, $to_scaled, 85);
                    } else {
                        $message = "Votre avatar n'a pas été pris en compte vous pourrez choisir une autre image sur votre compte utilisateur. Merci.";
                        Session::setMessage($message);
                        header('location: /erreur.html');
                        die;
                    }
                }
                if (isPortrait($to) === false && $height_original > 200) {
                    $height_scaled = $size;
                    $width_scaled = intval(($width_original / $height_original) * $height_scaled);

                    //  je redimensionne l'image à 200px de large max :  
                    if ($type == 'image/gif') {
                        $gd_original = imagecreatefromgif($to);
                        $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                        $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        imagegif($gd_scaled, $to_scaled);
                    } elseif ($type == 'image/png') {
                        $gd_original = imagecreatefrompng($to);
                        $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                        $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        imagepng($gd_scaled, $to_scaled);
                    } elseif ($type == 'image/jpeg') {
                        $gd_original = imagecreatefromjpeg($to);
                        $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
                        $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                        imagejpeg($gd_scaled, $to_scaled, 85);
                    } else {
                        $message = "Votre avatar n'a pas été pris en compte vous pourrez choisir une autre image sur votre compte utilisateur. Merci.";
                        Session::setMessage($message);
                        header('location: /erreur.html');
                        die;
                    }
                    header('location: /connexion.html');
                    die;
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


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/signUp.php');
include(__DIR__ . '/../views/templates/footer.php');
