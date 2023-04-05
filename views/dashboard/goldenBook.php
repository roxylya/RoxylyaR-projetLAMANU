
<p class="pt-2 mt-5"><?= $message ?? '' ?></p>

<div class="w-75 d-flex dashboard justify-content-between align-items-center">

    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 ms-0 ps-0 p-0">
        <li class="bgBlue">
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
        <li class="active bgBlue">
            <a class="gold" href="/controllers/dashboard/GoldenBook/getAllCommentsCtrl.php">Livre d'Or</a>
        </li>
    </ul>
    <!-- nav dashboard end -->
</div>
<!-- table start -->
<table class="w-75 dashboardUsers mt-0 p-1 bgBlue fondamento text-center mb-1">
    <tr class="bgBlue">
        <th>Date</th>
        <th>Pseudo</th>
        <th>Message</th>       
        <th>Actions</th>

    </tr>
    <?php foreach ($comments as $comment) { ?>
        <tr class="bgWhite">
            <td><?= date('d-m-Y H:i', strtotime($comment->created_at)) ?></td>
            <td><?= $comment->pseudo ?></td>
            <td><?= $comment->notice ?></td>
            <td><a href="/controllers/dashboard/Users/getUserCtrl.php?id_users=<?= $comment->id_users ?>"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
                <a href="/controllers/dashboard/Users/deleteUserCtrl.php<?= $comment->id_users ?>"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
            </td>
        </tr>
    <?php } ?>
</table>
<!-- table end -->
