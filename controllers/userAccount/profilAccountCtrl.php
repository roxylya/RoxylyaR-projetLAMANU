<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/config.php');
// on a besoin du models :
require_once(__DIR__ . '/../../models/User.php');

try {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: /accueil.html');
        die;
    } else {
        $user = $_SESSION['user'];
        // $userConnected = User::getById($id_users);


        // je crée un tableau où se trouveront tous les messages d'erreur :
        $error = [];

        // Vérifier les données envoyées :
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Nettoyer le mail :
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            if (empty($email)) {
                $error['email'] = 'Veuillez renseigner votre mail.';
            } else {
                // Valider le mail :
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = 'L\'adresse e-mail n\'est pas valide.';
                } else {
                    if (User::existsEmail($email) === true && $email != $user->email) {
                        // si le mail existe j'ajoute le message d'erreur au tableau d'alert :
                        $alert['Email'] = 'Email déjà existant.';
                    } else {
                        setcookie('email', $email);
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
                    if (User::existsPseudo($pseudo) === true && $pseudo != $user->pseudo) {
                        // si le pseudo existe j'ajoute le message d'erreur au tableau d'alert :
                        $alert['pseudo'] = 'Pseudo déjà existant.';
                    } else {
                        setcookie('pseudo', $pseudo);
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
                        setcookie('password', $password);
                    }
                }
            }

            // Vérification de l'image :
            if (isset($_FILES['avatar'])) {
                $avatar = $_FILES['avatar']['name'];
                $avatarType = $_FILES['avatar']['type'];
                $avatarError = $_FILES['avatar']['error'];

                if (empty($avatar)) {
                    $error['avatar'] = 'Une erreur est survenue.';
                } else {
                    if (!in_array($avatarType, EXTENSION)) {
                        $error['avatar'] = 'Le fichier envoyé n\'est pas valide.';
                    } else {
                        $oldAvatar = __DIR__ . '/../../public/uploads/avatars/avatar_' . $user->id_users . '.' . $user->extUserAvatar;
                        if (file_exists($oldAvatar)) {
                            //sinon enlever la condition et mettre un @ devant unlink;
                            unlink($oldAvatar);
                        }
                        $extUserAvatar = pathinfo($avatar, PATHINFO_EXTENSION);
                    }
                }
            } else {
                $error['avatar'] = 'Fichier non renseigné.';
            }

            if (empty($error)) {
                $updated_at = date('Y-m-d H:i:s');
                $userUpdate = new User();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $userUpdate->setPseudo($pseudo);
                $userUpdate->setEmail($email);
                $userUpdate->setPassword($password);
                $userUpdate->setExtUserAvatar($extUserAvatar);
                $userUpdate->setUpdated_at($updated_at);
                // Modifier les informations de l'user en fonction de son id sur la base de données :
                if ($userUpdate->update($user->id_users) === true) {
                    $code = 5;
                    $avatarName = 'avatar_' . $user->id_users . '.' . $extUserAvatar;
                    $from = $_FILES['avatar']['tmp_name'];
                    $to = LOCATION_UPLOAD . '/avatars/' . $avatarName;
                    move_uploaded_file($from, $to);
                    header('location: /mon-compte.html?code=' . $code);
                    die;
                } else {
                    $code = 4;
                }
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $_SESSION['errorMessage'] = $th->getMessage();
    header('location: /erreur.html');
    die;
}


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/profilAccount.php');
include(__DIR__ . '/../../views/templates/footer.php');
