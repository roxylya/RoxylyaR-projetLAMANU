<p class="pt-3"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">L</span>e <span class="bdRenaissanceH1 blue ">C</span>atalogue</h1>
<h2 class="dashboardDisplay text-center fondamento blue medium">Accessible à partir de 1110px de largeur d'écran ! </h2>
<div class="modeOff m-0 p-0">
    <div class="dashboard">
        <!-- nav dashboard start -->
        <ul class="navDashboard d-flex justify-content-center align-items-center m-0 me-3 ms-0 ps-0 p-0">
            <li class="bgBlue">
                <a class="gold " href="/controllers/dashboard/dashboardCtrl.php">Inscrits</a>
            </li>
            <li class="active bgBlue">
                <a class="gold" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php">Catalogue</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/controllers/dashboard/Galleries/getAllGalleriesCtrl.php">Galerie</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/controllers/dashboard/Orders/getAllOrdersCtrl.php">Commandes</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/controllers/dashboard/GoldenBook/getAllCommentsCtrl.php">Livre d'Or</a>
            </li>
        </ul>
        <!-- nav dashboard end -->
        <!-- research start -->
        <form method="get" action="/controllers/dashboard/dashboardCtrl.php" class="d-flex justify-content-around align-items-center ms-5">
            <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
            <input type="submit" name="btn-search" class="btn-search fondamento ms-3 me-2" value="Rechercher">
        </form>
        <!-- research end -->
    </div>
    <!-- table start -->
    <table class="modeOff dashboardUsers mt-0 fondamento text-center mb-1">
        <div class="add d-flex flex-column bgBlue justify-content-center align-items-center p-0 m-0">
            <a href="/controllers/dashboard/Catalogs/addCatalogCtrl.php" class="gold fondamento medium text-center py-2">+ Ajouter une nouvelle création</a>
            <tr class="bgBlue">
                <th>Crée le</th>
                <th>Créateur</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Actions</th>

            </tr>
            <?php foreach ($articles as $article) { ?>
                <tr class="bgWhite">
                    <td><?= date('d-m-Y H:i', strtotime($article->created_at)) ?></td>
                    <td><?= $article->pseudo ?></td>
                    <td><?= $article->nameArticle ?></td>
                    <td><?= $article->categoryName ?></td>
                    <td><?= $article->resume  ?></td>
                    <td><a href="/controllers/dashboard/Catalogs/updateCatalogCtrl.php?id_users=<?= $article->id_articles ?>"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
                        <a href="/controllers/dashboard/Catalogs/deleteCatalogCtrl.php<?= $article->id_articles ?>"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
                    </td>

                </tr>
            <?php } ?>
        </div>
    </table>
    <!-- table end -->
    <!-- pagination start -->
    <nav aria-label="Page navigation" class="modeOff m-0 mb-3 p-0">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
                <a href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                    <span aria-hidden="true">&#171; </span>
                </a>
            </li>
            <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
            <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
                <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                    <a class="page-link" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>

            <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
            <?php if ($page < $pageNb) { ?>
                <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                    <a class="page-link" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&#187;</span>
                    </a>
                <?php } ?>
                </li>
        </ul>
    </nav>
    <!-- pagination end -->
</div>