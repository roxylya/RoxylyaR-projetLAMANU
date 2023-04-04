<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/constants.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../../config/config.php');
// on a besoin de la session flash :
require_once(__DIR__ . '/../../config/SessionFlash.php');
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

        $error = [];
        // Vérifier les données envoyées :
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer le mot de passe :
            $passwordDelete =  $_POST['passwordDelete'];
            if (empty($passwordDelete)) {
                $error['passwordDelete'] = 'Veuillez entrer votre mot de passe.';
            } else {
                // On vérifie que le mot de passe correspond au mail enregistré dans la bd avec la fonction password_verify()
                // pour savoir d'où cela provient.
                $hash = $user->password;

                if (!password_verify($passwordDelete, $hash)) {
                    $error['passwordDelete'] = 'Erreur de mot de passe.';
                } else {
                    if (User::delete($user->id_users) === true) {
                        $oldAvatar = LOCATION_UPLOAD . '/avatars/avatar_' . $user->id_users . '.' . $user->extUserAvatar;
                        if (file_exists($oldAvatar)) {
                            // var_dump($oldAvatar);
                            unlink($oldAvatar);
                        }
                        $code = 1;
                        header('location: /controllers/logOutCtrl.php?code=' . $code);
                        die;
                    } else {
                        $code = 0;
                        header('location: /mon-compte-mes-informations.html?code=' . $code);
                        die;
                    }
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


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/deleteUserAccount.php');
include(__DIR__ . '/../../views/templates/footer.php');
