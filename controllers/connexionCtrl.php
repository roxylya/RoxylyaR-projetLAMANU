<?php 
include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/connexion.php');
include(__DIR__ . '/../views/templates/footer.php');

// require(__DIR__ . '/../config/constants.php');
// $alert = [];

// // Vérifier le mail :
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//     // Nettoyer le mail :
//     $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
//     if (empty($email)) {
//         $alert['email'] = "Veuillez renseigner votre mail.";
//     } else {
//         // Valider le mail :
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $alert['email'] = "L'adresse e-mail n'est pas valide.";
//         }
//     }

//     // Récupérer le password :
//     $password =  $_POST['password'];
//     $passwordConfirm =  $_POST['passwordConfirm'];
//     if (empty($password) && empty($passwordConfirm)) {
//         $alert['password'] = 'Veuillez entrer un mot de passe.';
//         $alert['password'] = 'Veuillez entrer un mot de passe.';
//     } else {

//         // Mots de passe identiques ?
//         if ($password != $passwordConfirm) {
//             $alert['passwords'] = 'Les mots de passe doivent être identiques.';
//         } else {
//             // Mot de passe correspond à la regex ?
//             if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/'))) && !filter_var($passwordConfirm, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
//                 $alert['password'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
//                 $alert['password2'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
//             } elseif (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
//                 $alert['password'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
//             } elseif (!filter_var($passwordConfirm, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')))) {
//                 $alert['password2'] = 'Votre mot de passe doit contenir au moins 8 caractère dont 1 Majuscule, 1 miniscule, 1 caractère spécial et 1 chiffre.';
//             } else {
//                 $passwordHash = password_hash($password, PASSWORD_DEFAULT);
//             }
//         }


//         // Nettoyer le prénom :
//         $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
//         if (empty($firstname)) {
//             $alert['firstname'] = 'Veuillez entrer votre prénom.';
//         } else {
//             // Prénom correspond à la regex ?
//             if (!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')))) {
//                 $alert['firstname'] = 'Format incorrect.';
//             }
//         }

//     // Vérification de l'image :
//     if (isset($_FILES['avatar'])) {
//         $file = $_FILES['avatar']['name'];
//         $fileType = $_FILES['avatar']['type'];
//         $fileError = $_FILES['avatar']['error'];

//         if (empty($file)) {
//             $alert['avatar'] = 'Une erreur est survenue.';
//         } else {
//             if (!in_array($fileType, EXTENSION)) {
//                 $alert['avatar'] = 'Le fichier envoyé n\'est pas valide.';
//             } else {
//                 $extension = pathinfo($file, PATHINFO_EXTENSION);
//                 $fileName = 'Jack' . $extension;
//                 $from = $_FILES['avatar']['tmp_name'];
//                 $to = __DIR__ . '/../public/uploads/avatar/' . $fileName;
//                 move_uploaded_file($from, $to);
//             }
//         }
//     } else {
//         $alert['avatar'] = 'Fichier non renseigné.';
//     }

// include(__DIR__ . '/../views/templates/header.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($alert)) {
//     include(__DIR__ . '/../views/userCount.php');
// } else {
//     include(__DIR__ . '/../views/connexion.php');
// }

//  include(__DIR__ . '/../views/templates/footer.php');