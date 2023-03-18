<?php
session_start();
// vidage des données de session :
$_SESSION = array();

// si cookies :
// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// on détruit la session.
session_destroy();

header('location: /../controllers/homeCtrl.php');
die;