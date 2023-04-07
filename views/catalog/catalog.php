<h1 class="text-center gold blackClover"><span class="bdRenaissanceH1">C</span>atalogue</h1>

<!-- research start -->
<form method="get" action="/controllers/catalog/catalogCtrl.php" class="d-flex justify-content-around align-items-center ms-5 py-3">
    <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
    <input type="submit"  class="btn-search fondamento ms-3 me-2" value="Rechercher">
</form>
<!-- research end -->
<div class="catalog d-flex flex-wrap justify-content-around align-items-center mb-2">
    <?php foreach ($articles as $article) {?>
    <!-- article start -->
    <div class="box bgBlue d-flex flex-column justify-content-center align-items-center p-3 m-md-3 my-3">
        <!-- titre de l'article -->
        <h2 class="gold blackClover text-center medium"><?= $article->articleName ?></h2>
        <p class="little gold fondamento"><?= $article->pseudo ?> <span class="blue">|</span> <?= date('d-m-Y', strtotime($article->created_at)) ?> <span class="blue">|</span> <?= $article->categoryName ?></p>
        <!-- image de l'article -->
        <img class="py-2" src="/public/uploads/catalog/<?= $article->categoryName . '_' . $article->id_articles . '.png'  ?>" alt="<?= $article->articleName ?>">
        <!-- descritpion de l'article -->
        <p class="little gold fondamento justify">
        <?= $article->resume ?>
        </p>
    </div>
    <!-- article end -->
    <?php } ?>
</div>

<!-- pagination start -->
<nav aria-label="Page navigation" class="modeOff m-0 mb-3 p-0">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
            <a href="/controllers/catalog/catalogCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                <span aria-hidden="true">&#171; </span>
            </a>
        </li>
        <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
        <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
            <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                <a class="page-link" href="/controllers/catalog/catalogCtrl.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php } ?>

        <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
        <?php if ($page < $pageNb) { ?>
            <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                <a class="page-link" href="/controllers/catalog/catalogCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&#187;</span>
                </a>
            <?php } ?>
            </li>
    </ul>
</nav>
<!-- pagination end -->