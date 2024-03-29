<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../config/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');
// on a besoin d'accéder au helper :
require_once(__DIR__ . '/../helper/dd.php');
// on a besoin du model :
require_once(__DIR__ . '/../models/User.php');
// on a besoin du model :
require_once(__DIR__ . '/../config/SessionFlash.php');

try {
     // on démarre la session :
    $error = [];
    $message = Session::getMessage();

    // Vérifier les données envoyées :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le mail :
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        if (empty($email)) {
            $error['email'] = "Veuillez renseigner votre email.";
        } else {
            // Valider le mail :
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "L'adresse e-mail n'est pas valide.";
            } else {
                if (!$user = User::existsEmail($email)) {
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

        // Si pas de message d'erreur :
        if (empty($error)) {
            $user = User::getByEmail($email);
            if ($user->validated_at != NULL) {
                session_start();
                $_SESSION['user'] = $user;
                if (!isset($_SESSION['user'])) {
                    header('location: /accueil.html');
                    die;
                } else {
                    $user = $_SESSION['user'];
                    header('location: /mon-compte.html');
                }
            } else {
                $message = 'Validez votre mail pour pouvoir vous connecter.';
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
include(__DIR__ . '/../views/signIn.php');
include(__DIR__ . '/../views/templates/footer.php');
