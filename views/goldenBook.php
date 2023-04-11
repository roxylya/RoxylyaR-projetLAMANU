<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">L</span>ivre d' <span class="bdRenaissanceH1">O</span>r</h1>
</div>
<div class="d-flex justify-content-around align-items-center">
    <!-- bouton ajout de commentaire accessible seulement pour les users connectés start -->
<?php if(isset($user)) {?>

<a href="/controllers/addCommentCtrl.php"><input type="button" class="btn-comment fondamento" value="+ Ajouter un commentaire"></a>

<?php }?>
    <!-- bouton ajout de commentaire accessible seulement pour les users connectés end -->
<!-- research start -->
<form method="get" action="/controllers/goldenBookCtrl.php" class="d-flex justify-content-around align-items-center ms-5 py-3">
    <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
    <input type="submit" class="btn-search fondamento ms-3 me-2" value="Rechercher">
</form>
<!-- research end -->

</div>
<div class="goldenBook d-flex flex-wrap justify-content-around align-items-center mt-3">
    <?php foreach ($comments as $comment) { ?>
        <!-- comment start -->
        <div class="box bgBlue comments m-3 m-md-4 p-3 d-flex flex-column">
            <!-- comment header -->
            <div class="commentHeader d-flex justify-content-around align-items-center ">
                <img src="/public//uploads/avatars/avatar_<?= $comment->id_users . '.' . $comment->extUserAvatar ?>?<?= rand(1, 2000) ?>" alt="avatar de <?= $comment->pseudo ?>">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2 class="ms-2 gold blackClover large text-center"><?= $comment->pseudo ?></h2>
                    <p class="gold small fondamento"><?= date('d-m-Y,  H:i', strtotime($comment->created_at)) ?></p>
                </div>
            </div>
            <!-- comment body -->
            <p class="pt-2 gold fondamento justify"><?= $comment->notice ?></p>
        </div>
        <!-- comment end -->
    <?php  } ?>
</div>
<!-- pagination start -->
<nav aria-label="Page navigation" class="modeOff m-0 mb-3 p-0">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
            <a href="/controllers/goldenBookCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                <span aria-hidden="true">&#171; </span>
            </a>
        </li>
        <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
        <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
            <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                <a class="page-link" href="/controllers/goldenBookCtrl.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php } ?>

        <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
        <?php if ($page < $pageNb) { ?>
            <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                <a class="page-link" href="/controllers/goldenBookCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&#187;</span>
                </a>
            <?php } ?>
            </li>
    </ul>
</nav>
<!-- pagination end -->