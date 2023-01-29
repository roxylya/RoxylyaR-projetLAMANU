<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/assets/img/logo20.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <title>Roxylya "R"</title>
</head>

<body>
    <!-- header start -->
    <header>
        <!-- nav start -->
        <nav class="nav justify-content-around align-items-center py-3">
            <a class="nav-link active" href="/controllers/homeCtrl.php" aria-current="page"><img class="logo"
                    src="/public/assets/img/logo800.png" alt="lettre R, façon vitrail"> Roxylya "R"</a>
            <div class="d-flex">
                <a class="nav-link d-none d-lg-block" aria-current="page" href="/controllers/catalogCtrl.php">Catalogue</a>
                <a class="nav-link d-none d-lg-block" href="/controllers/galleryCtrl.php">Galerie</a>
                <a class="nav-link d-none d-lg-block" href="/controllers/goldenBookCtrl.php">Livre d'Or</a>
                <a class="nav-link d-none d-lg-block" href="/controllers/connexionCtrl.php">Connexion</a>
            </div>
            <button class="d-lg-none navbar-toggler m-0 p-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/controllers/catalogCtrl.php">Catalogue</a>
                    <li class="nav-item">
                        <a class="nav-link" href="/controllers/galleryCtrl.php">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/controllers/goldenBookCtrl.php">Livre d'Or</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/controllers/connexionCtrl.php">Connexion</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- nav end -->
        <img class="topFrise position-absolute bottom-10 end-0" alt="Responsive image"
            src="/public/assets/img/friseroxylyar.png" alt="frise dorée type renaissance">
    </header>
    <!-- header end -->
