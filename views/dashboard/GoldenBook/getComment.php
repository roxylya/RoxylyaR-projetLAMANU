<p class="pt-3 fondamento medium blue"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">M</span>odifier un <span class="bdRenaissanceH1 blue ">C</span>ommentaire</h1>
<div class="dashboard d-flex flex-column justify-content-center align-items-center">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 p-0">
        <li class="bgBlue">
            <a class="gold " href="/controllers/dashboard/dashboardCtrl.php">Inscrits</a>
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
    <div class="w-100 d-flex bgBlue formUpdateShort flex-column justify-content-center align-items-start">
        <div class="w-100 d-flex flex-lg-row flex-column justify-content-between align-items-center">
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- notice -->
                <div class="w-100 form-group pt-2">
                    <label for="notice" class="form-label">Commentaires</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <textarea class="form-control notice" name="notice" id="notice" rows="10" minlength="5" maxlength="300" value="<?= $notice ?? $theComment->notice ?>"><?= $notice ?? $theComment->notice ?></textarea>
                        <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="red little text-center"><?= $error['notice'] ?? '' ?></p>
                </div>
            </form>
            <!-- fermeture formulaire -->
        </div>
    </div>
</div>