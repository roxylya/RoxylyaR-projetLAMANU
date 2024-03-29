<p class="pt-3"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">L</span>es <span class="bdRenaissanceH1 blue ">C</span>ommandes</h1>
<h2 class="dashboardDisplay text-center fondamento blue medium">Accessible à partir de 1110px de largeur d'écran ! </h2>
<div class="modeOff m-0 p-0">
    <div class="dashboard">
        <!-- nav dashboard start -->
        <ul class="navDashboard d-flex justify-content-center align-items-center m-0 me-3 ms-0 ps-0 p-0">
            <li class="bgBlue">
                <a class="gold " href="/admin-les-inscrits.html">Inscrits</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/admin-catalogue.html">Catalogue</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/admin-galerie.html">Galerie</a>
            </li>
            <li class="active bgBlue">
                <a class="gold" href="/admin-commandes.html">Commandes</a>
            </li>
            <li class="bgBlue">
                <a class="gold" href="/admin-livre-d-or.html">Livre d'Or</a>
            </li>
        </ul>
        <!-- nav dashboard end -->
        <!-- research start -->
        <form method="get" action="/admin-commandes.html" class="d-flex justify-content-around align-items-center ms-5">
            <input type="search" name="search" id="search" placeholder="Rechercher" value="<?= $research ?? '' ?>">
            <input type="submit" class="btn-search fondamento ms-3 me-2" value="Rechercher">
        </form>
        <!-- research end -->
    </div>
    <!-- table start -->
    <table class="w-100 modeOff dashboardUsers mt-0 p-1 bgBlue fondamento text-center mb-1">
        <div class="add d-flex flex-column bgBlue justify-content-center align-items-center p-0 m-0">
            <a href="#" class="grey fondamento medium text-center py-2">+ Ajouter une nouvelle commande</a>
            <!-- /admin-ajouter-une-commande.html -->
            <tr class="bgBlue">
                <th>Crée le</th>
                <th>Pseudo</th>
                <th>Catégorie</th>
                <th>Livrée le</th>
                <th>Actions</th>

            </tr>
            <?php foreach ($orders as $order) { ?>
                <tr class="bgWhite">
                    <td><?= date('d-m-Y H:i', strtotime($order->created_at)) ?></td>
                    <td><?= $order->pseudo ?></td>
                    <td><?php if ($order->id_banners != NULL) {
                            echo ('Fresques');
                        }
                        if ($order->id_portraits != NULL) {
                            echo ('Portraits');
                        }
                        if ($order->id_outfits != NULL) {
                            echo ('Tenues');
                        } ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($order->received_at)) ?></td>
                    <td><a href="/admin-modifier-une-commande.html?id_users=<?= $order->id_orders ?>"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
                        <a href="/controllers/dashboard/Orders/deleteOrderCtrl.php<?= $order->id_orders ?>"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
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
                <a href="/admin-commandes.html?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                    <span aria-hidden="true">&#171; </span>
                </a>
            </li>
            <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
            <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
                <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                    <a class="page-link" href="/admin-commandes.html?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>

            <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
            <?php if ($page < $pageNb) { ?>
                <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                    <a class="page-link" href="/admin-commandes.html?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&#187;</span>
                    </a>
                <?php } ?>
                </li>
        </ul>
    </nav>
    <!-- pagination end -->
</div>