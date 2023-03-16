<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/config.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/User.php');

try {
    $code = intval(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT));
    $error = [];

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le mail :
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        if (empty($email)) {
            $error['email'] = "Veuillez renseigner votre mail.";
        } else {
            // Valider le mail :
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "L'adresse e-mail n'est pas valide.";
            } else {
                if (!$user = User::existsMail($email)) {
                    $error['email'] = "L'adresse mail n'est pas reconnue.";
                }
            }
        }

        // Récupérer le mot de passe :
        $password =  $_POST['password'];
        if (empty($password)) {
            $error['password'] = 'Veuillez entrer votre mot de passe.';
        } else {
            // On vérifie que le mot de passe correspond au mail enregistré dans la bd avec la fonction password_verify()
            // pour savoir d'où cela provient.

            if ($user = User::getByEmail($email)) {

                $hash = $user->password;

                if (!password_verify($password, $hash)) {
                    $error['password'] = 'Erreur de mot de passe.';
                }
            }
        }

        if (empty($error)) {
            $user = User::getByEmail($email);
            // on démarre la session :
            session_start(['cookie_lifetime' => 86400, ]);
            $_SESSION['id_users'] = $user->id_users;

            if ($user->id_roles === 3) {
                header('location: /controllers/userAccount/userAccountCtrl.php');
                die;
            }
            if ($user->id_roles === 1 || $user->id_roles === 2) {
                header('location: /controllers/dashboard/dashboardCtrl.php');
                die;
            }
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../controllers/errorCtrl.php');
    die;
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/connexion.php');
include(__DIR__ . '/../views/templates/footer.php');
