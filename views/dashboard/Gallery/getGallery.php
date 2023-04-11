<p class="pt-3 fondamento medium blue"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">M</span>odifier une <span class="bdRenaissanceH1 blue ">O</span>euvre</h1>
<div class="dashboard d-flex flex-column justify-content-center align-items-center">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 p-0">
        <li class="bgBlue">
            <a class="gold " href="/controllers/dashboard/dashboardCtrl.php">Inscrits</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/controllers/dashboard/Catalogs/getAllCatalogsCtrl.php">Catalogue</a>
        </li>
        <li class="active bgBlue">
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
    <div class="w-100 d-flex bgBlue formUpdateShort flex-column justify-content-center align-items-start">
        <div class="w-100 d-flex flex-lg-row flex-column justify-content-between align-items-center">
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- name -->
                <div class="w-100 form-group">
                    <label for="name">Titre :</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control" id="name" minlength="3" maxlength="50" name="name" value="<?= $name ?? $theGallery->galleryName  ?>" required>
                        <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="red little text-center"><?= $error['name'] ?? '' ?></p>
                </div>
            </form>
            <!-- fermeture formulaire -->
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- types -->
                <div class="w-100 form-group">
                    <label for="id_types">Catégorie :</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select" name="id_types" id="id_types" aria-label="Catégorie">
                            <option selected>Choisissez</option>
                            <?php foreach ($types as $type) {
                                $idTypes = $theGallery->id_types ?? $id_types; ?>
                                <option value="<?= $type->id_types ?>" <?= (($idTypes == $type->id_types) ? 'selected' : '') ?>><?= $type->name ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="red little text-center"><?= $error['id_types'] ?? '' ?></p>
                </div>
            </form>
        </div>
        <!-- fermeture formulaire -->

        <!-- image de l'article -->
        <img class="align-self-center mt-3" src="/public/uploads/gallery/<?= $theGallery->typeName . '_' . $theGallery->id_galleries . '.png'  ?>?<?= rand(1, 2000) ?>" alt="<?= $theGallery->galleryName ?>">
        <!-- ouverture formulaire -->
        <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
            <!-- récupération picture -->
            <div class="w-100 form-group">
                <label for="picture" class="form-label">Oeuvre :</label>
                <div class="d-flex justify-content-center align-items-center">
                    <input class="form-control" type="file" id="picture" name="picture" accept="image/png" required>
                    <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                </div>
                <p class="red little text-center"><?= $error['picture'] ?? '' ?></p>
            </div>

        </form>
        <!-- fermeture formulaire -->
    </div>
    <!-- fermeture formulaire -->
</div>