<h1 class="text-center gold blackClover"><span class="bdRenaissanceH1">G</span>alerie</h1>
<!-- research start -->
<form method="get" action="/controllers/gallery/galleryCtrl.php" class="d-flex justify-content-around align-items-center ms-5 py-3">
    <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
    <input type="submit" class="btn-search fondamento ms-3 me-2" value="Rechercher">
</form>
<!-- research end -->
<div class="gallery d-flex flex-wrap justify-content-around align-items-center pt-2 mb-2">
    <?php foreach ($galleries as $gallery) { ?>
        <!-- article start -->
        <div class="box bgBlue d-flex flex-column justify-content-center align-items-center p-3 m-md-2 my-2">
            <!-- titre de l'article -->
            <h2 class="gold blackClover text-center medium"><?= $gallery->galleryName ?></h2>
            <p class="little gold fondamento">Cassiopée Nox <span class="blue">|</span> <?= date('d-m-Y', strtotime($gallery->created_at)) ?><span class="blue">|</span> <?= $gallery->typeName ?></p>
            <!-- image de l'article -->
            <img class="pt-4" src="/public/uploads/gallery/<?= $gallery->typeName . '_' . $gallery->id_galleries . '.png'  ?>" alt="fresque <?= $gallery->galleryName ?>">
        </div>
        <!-- article start --> <?php } ?>
</div>
<!-- pagination start -->
<nav aria-label="Page navigation" class="modeOff m-0 mb-3 p-0">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
            <a href="/controllers/gallery/galleryCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                <span aria-hidden="true">&#171; </span>
            </a>
        </li>
        <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
        <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
            <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                <a class="page-link" href="/controllers/gallery/galleryCtrl.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php } ?>

        <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
        <?php if ($page < $pageNb) { ?>
            <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                <a class="page-link" href="/controllers/gallery/galleryCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&#187;</span>
                </a>
            <?php } ?>
            </li>
    </ul>
</nav>
<!-- pagination end -->