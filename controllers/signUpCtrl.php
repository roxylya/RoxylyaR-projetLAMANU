<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin d'accéder au tableau de messages :
require_once(__DIR__ . '/../config/config.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');

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
                $error['avatar'] = 'Le fichier envoyé n\'est pas valide.';
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
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            // $validated_at = 'NOPE';
            $id_roles = 3;

            $user = new User();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setExtUserAvatar($extUserAvatar);
            $user->setCreated_at($created_at);
            $user->setUpdated_at($updated_at);
            // $user->setValidated_at($validated_at);
            $user->setId_roles($id_roles);
            // Ajouter l'enregistrement du nouveau user à la base de données :
            if ($user->add() === true) {
                $code = 12;
                // je sauvegarde l'avatar :
                $user = User::getByEmail($email);
                $avatarName = 'avatar_' . $user->id_users . '.' . $extUserAvatar;
                $from = $_FILES['avatar']['tmp_name'];
                $to = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                move_uploaded_file($from, $to);

                // définition des points de référence image en portrait ou en paysage :
                $size = 400;

                $height_original = imagesy($gd_original);
                $width_original = imagesx($gd_original);

                $isPortrait = ($height_original > $width_original) ? true : false;
                if ($isPortrait === true) {
                    $width_scaled = $size;
                    $height_scaled = -1;
                } else {
                    $width_scaled = round($width_original / $height_original) * $height_scaled;
                    $height_scaled = $size;
                }

                //  je redimensionne l'image à 400px de large max :  
                if ($extUserAvatar == 'image/gif') {
                    $gd_original = imagecreatefromgif($to);
                    $gd_scaled = imagescale($gd_original, $size, -1, IMG_BICUBIC);
                    $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                    imagegif($gd_scaled, $to_scaled);
                    $height_scaled = imagesy($gd_scaled);
                    $y_cropped = ($height_scaled - $size) / 2;
                    $width_scaled = imagesx($gd_scaled);
                    $x_cropped = ($width_scaled - $size) / 2;
                    if ($height_scaled > $width_scaled) {
                        // portrait :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $y_cropped, 'width' => $size, 'height' => $size]);
                    } else {
                        // paysage :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $x_cropped, 'width' => $size, 'height' => $size]);
                    }
                    imagegif($gd_scaled, $to_scaled, 85);
                } elseif ($extUserAvatar == 'image/png') {
                    $gd_original = imagecreatefrompng($to);
                    $gd_scaled = imagescale($gd_original, $size, -1, IMG_BICUBIC);
                    $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                    imagepng($gd_scaled, $to_scaled);
                    $height_scaled = imagesy($gd_scaled);
                    $y_cropped = ($height_scaled - $size) / 2;
                    $width_scaled = imagesx($gd_scaled);
                    $x_cropped = ($width_scaled - $size) / 2;
                    if ($height_scaled > $width_scaled) {
                        // portrait :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $y_cropped, 'width' => $size, 'height' => $size]);
                    } else {
                        // paysage :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $x_cropped, 'width' => $size, 'height' => $size]);
                    }
                    imagepng($gd_scaled, $to_scaled, 85);
                } elseif ($extUserAvatar == 'image/JPG' || $extUserAvatar == 'image/jpg' || $extUserAvatar == 'image/jpeg') {
                    $gd_original = imagecreatefromjpeg($to);
                    $gd_scaled = imagescale($gd_original, $size, -1, IMG_BICUBIC);
                    $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                    imagejpeg($gd_scaled, $to_scaled);
                    $height_scaled = imagesy($gd_scaled);
                    $y_cropped = ($height_scaled - $size) / 2;
                    $width_scaled = imagesx($gd_scaled);
                    $x_cropped = ($width_scaled - $size) / 2;
                    if ($height_scaled > $width_scaled) {
                        // portrait :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $y_cropped, 'width' => $size, 'height' => $size]);
                    } else {
                        // paysage :
                        imagecrop($gd_scaled, ['x' => 0, 'y' => $x_cropped, 'width' => $size, 'height' => $size]);
                    }
                    imagejpeg($gd_scaled, $to_scaled, 85);
                } else {
                    $message = 'Image non prise en charge.';
                }




                // mail de validation :
                $link = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/controllers/validateMailCtrl.php?id_users=' . $user->id_users;
                $for = $user->mail;
                $subject = 'Validation de votre inscription sur Roxylya R';
                $message = 'Bonjour, <br>Afin de valider votre inscription sur le site Roxylya R, merci de cliquer sur ce <a href="' . $link . '">lien</a>.';
                mail($for, $subject, $message);

                //     array|string $additional_headers = [],
                //     string $additional_params = ""
                // php mailer pour faire de l'envoi de mail (configurer le server smtp) 

                // redirection vers la page de connexion :
                header('location: /connexion.html?code=' . $code);
                die;
            } else {
                $code = 14;
                header('location: /inscription.html?code=' . $code);
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
