<?php
try {
    session_start();
    $code = intval(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT));
    if ($code === 1) {
        // vidage des données de session :
        unset($_SESSION['user']);

        // si cookies :
        // Si vous voulez détruire complètement la session, effacez également
        // le cookie de session.
        // Note : cela détruira la session et pas seulement les données de session !
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // on détruit la session.
        session_destroy();
        header('location: /accueil.html');
        die;
    }


    // vidage des données de session :
    $_SESSION = array();

    // si cookies :
    // Si vous voulez détruire complètement la session, effacez également
    // le cookie de session.
    // Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // on détruit la session.
    session_destroy();

    header('location: /accueil.html');
    die;
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $message = $th->getMessage();
    Session::setMessage($message);
    header('location: /erreur.html');
    die;
}
