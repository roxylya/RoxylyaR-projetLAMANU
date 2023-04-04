<!-- <div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">B</span>ienvenue Chef <?= $user->pseudo ?> !</h1>
</div> -->
<p class="pt-2 mt-5"><?= $message ?? '' ?></p>

<div class="w-75 d-flex justify-content-between align-items-center">

    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 ms-0 ps-0 p-0">
        <li class="active bgBlue">
            <a class="gold " href="/controllers/dashboard/Users/getAllUsersCtrl.php">Inscrits</a>
        </li>
        <li class="bgBlue">
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
    <form method="get" action="/controllers/dashboard/dashboardCtrl.php" class="d-flex justify-content-around align-items-center">
        <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
        <input type="submit" name="btn-search" class="btn-search fondamento ms-3" value="Rechercher">
    </form>
    <!-- research end -->
</div>
<!-- table start -->
<table class="w-75 dashboardUsers mt-0 p-1 bgBlue fondamento text-center mb-1">
    <tr class="bgBlue">
        <th>Rôle</th>
        <th>Pseudo</th>
        <th>Mail</th>
        <th>Crée le</th>
        <th>Validé le</th>
        <th>Commande</th>
        <th>Commentaires</th>
        <th>Actions</th>

    </tr>
    <?php foreach ($allUsers as $allUser) { ?>
        <tr class="bgWhite">
            <td><?= $allUser->name ?></td>
            <td><?= $allUser->pseudo ?></td>
            <td><?= $allUser->email ?></td>
            <td><?= date('d-m-Y H:i', strtotime($allUser->created_at)) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($allUser->validated_at)) ?></td>
            <td></td>
            <td></td>
            <td><a href="/controllers/dashboard/Users/getUserCtrl.php?id_users=<?= $allUser->id_users ?>"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
                <a href="/controllers/dashboard/Users/deleteUserCtrl.php<?= $allUser->id_users ?>"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
            </td>

        </tr>
    <?php } ?>
</table>
<!-- table end -->
<!-- pagination start -->
<nav aria-label="Page navigation m-0 mb-3 p-0">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
            <a href="/controllers/dashboard/dashboardCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                <span aria-hidden="true">&#171; </span>
            </a>
        </li>
        <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
        <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
            <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                <a class="page-link" href="/controllers/dashboard/dashboardCtrl.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php } ?>

        <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
        <?php if ($page < $pageNb) { ?>
            <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                <a class="page-link" href="/controllers/dashboard/dashboardCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&#187;</span>
                </a>
            <?php } ?>
            </li>
    </ul>
</nav>
<!-- table end -->