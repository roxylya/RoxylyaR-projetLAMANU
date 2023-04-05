<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/assets/img/logo20.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fondamento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <title>Roxylya "R"</title>
</head>

<body>
    <!-- header start -->
    <header class="bgBlue">
        <!-- nav start -->
        <nav class="nav justify-content-between align-items-center blackClover py-3 position-relative">
            <a class="nav-link m-0" href="/accueil.html"><img class="logo" src="/public/assets/img/logo800.png" alt="lettre R, façon vitrail"> <span class="titleRoxylyaR">Roxylya "R"</span> </a>
            <div class="d-flex justify-content-between align-items-center p-0 m-0">
                <a class="nav-link d-none d-lg-block" aria-current="page" href="/catalogue.html">Catalogue</a>
                <a class="nav-link d-none d-lg-block" href="/galerie.html">Galerie</a>
                <a class="nav-link d-none d-lg-block" href="/livre-d-or.html">Livre d'Or</a>
            </div>
            <div class="d-flex flex-md-row flex-column justify-content-around align-items-center pe-md-5">
                <img class="avatarUser text-center" src="/public/uploads/avatars/avatar_<?= $user->id_users . '.' . $user->extUserAvatar ?>?<?= rand(1,2000) ?>" alt="avatarUser">
                <a class="nav-link pseudoUser p-0 ms-1 me-md-3" href="/mon-compte.html" aria-current="page"><?= $user->pseudo ?></a>
            </div>
            <button class="d-lg-none navbar-toggler m-0 pe-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="d-lg-none navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/catalogue.html">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/galerie.html">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/livre-d-or.html">Livre d'Or</a>
                    </li>
                </ul>
            </div>
            <a class="exit position-absolute bottom-0 end-0" href="/controllers/logOutCtrl.php" title="Se déconnecter"><img class="exitDoor" src="/public/assets/img/door.png" alt="porte ouverte icône de déconnexion"></a>
        </nav>
        <!-- nav end -->
        <img class="topFrise position-absolute bottom-10 end-0" alt="Responsive image" src="/public/assets/img/friseroxylyar.png" alt="frise dorée type renaissance">
    </header>
    <!-- header end -->
    <main class="py-5 m-0">
        <div class="d-flex flex-column justify-content-center align-items-center m-0 mt-3 ">