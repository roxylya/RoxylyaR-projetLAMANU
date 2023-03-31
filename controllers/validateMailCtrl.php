<?php
try {
    $id_users = intval(filter_input(INPUT_GET, 'id_users', FILTER_SANITIZE_NUMBER_INT));

    $validationIsOk = User::updateValidate($id_users);

    if ($validationIsOk) {
        // session_start();
        // $user = User::getById($id_users);
        // $user = $_SESSION['user'];
        $code = 13;
        header('location: /connexion.html?code=' . $code);
        die;
    } else {
        $code = 12;
        header('location: /accueil.html' . $code);
        die;
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $_SESSION['errorMessage'] = $th->getMessage();
    header('location: /erreur.html');
    die;
}
