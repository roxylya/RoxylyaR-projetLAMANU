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
    $id_users = $_SESSION['id_users'];
    $userConnected = User::getById($id_users);
    $extUserAvatar = $userConnected->extUserAvatar;
    // je crée un tableau où se trouveront tous les messages d'erreur :
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer le mot de passe :
        $password =  $_POST['passwordDelete'];
        if (empty($password)) {
            $error['passwordDelete'] = 'Veuillez entrer votre mot de passe.';
        } else {
            // On vérifie que le mot de passe correspond au mail enregistré dans la bd avec la fonction password_verify()
            // pour savoir d'où cela provient.
            $hash = $userConnected->password;

            if (!password_verify($password, $hash)) {
                $error['passwordDelete'] = 'Erreur de mot de passe.';
            } else {
                if(User::delete($id_users) === true){
                    $oldAvatar = __DIR__ . '/../../public/uploads/avatars/avatar_' . $id_users . '.' . $extUserAvatar;
                    if (file_exists($oldAvatar)) {
                        // var_dump($oldAvatar);
                        unlink($oldAvatar);
                    }
                    $code= 1;
                    header('location: /controllers/userAccount/logOutCtrl.php?code='. $code);
                    die;
                }else{
                    $code= 0;
                    header('location: /controllers/userAccount/profilAccountCtrl.php?code='. $code);
                    die;
                }
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../../views/templates/header.php');
    include(__DIR__ . '/../../views/error.php');
    include(__DIR__ . '/../../views/templates/footer.php');
    die;
}


include(__DIR__ . '/../../views/templates/headerUserAccount.php');
include(__DIR__ . '/../../views/userAccount/profilAccount.php');
include(__DIR__ . '/../../views/templates/footer.php');
