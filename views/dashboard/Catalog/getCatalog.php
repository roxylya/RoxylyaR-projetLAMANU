<p class="pt-3 fondamento medium blue"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">M</span>odifier un <span class="bdRenaissanceH1 blue ">I</span>nscrit</h1>
<div class="dashboard d-flex flex-column justify-content-center align-items-center">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0 p-0">
        <li class="active bgBlue">
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
    <div class="w-100 d-flex bgBlue formUpdateShort flex-column justify-content-center align-items-start">
        <div class="w-100 d-flex flex-lg-row flex-column justify-content-between align-items-center">
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- name -->
                <div class="w-100 form-group m-0">
                    <label for="name">Titre :</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control fondamento" id="name" minlength="3" maxlength="50" name="name" value="<?= $name ?? $theArticle->articleName ?>" required>
                        <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="red little text-center"><?= $error['name'] ?? '' ?></p>
                </div>
            </form>
            <!-- fermeture formulaire -->
            <!-- ouverture formulaire -->
            <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
                <!-- categories -->
                <div class="w-100 form-group m-0">
                    <label for="id_categories">Catégorie :</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select" name="id_categories" id="id_categories" aria-label="Catégorie">
                            <option selected>Choisissez</option>
                            <?php foreach ($categories as $category) {
                                $idCat = $theArticle->id_categories ?? $id_categories; ?>
                                <option value="<?= $category->id_categories ?>" <?= (($idCat == $category->id_categories) ? 'selected' : '') ?>><?= $category->name ?> </option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                    </div>
                    <p class="red little text-center"><?= $error['id_categories'] ?? '' ?></p>
                </div>
            </form>
        </div>
        <!-- fermeture formulaire -->
        <!-- ouverture formulaire -->
        <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3">
            <!-- Resume -->
            <div class="w-100 form-group pt-2">
                <label for="resume" class="form-label">Description</label>
                <div class="d-flex justify-content-center align-items-center">
                    <textarea class="form-control resume" name="resume" id="resume" rows="3" minlength="30" maxlength="180"><?= $resume ?? $theArticle->resume ?></textarea>
                    <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                </div>
                <p class="red little text-center"><?= $error['resume'] ?? '' ?></p>
            </div>
        </form>
        <!-- fermeture formulaire -->

         <!-- image de l'article -->
         <img class="align-self-center" src="/public/uploads/catalog/<?= $theArticle->categoryName . '_' . $theArticle->id_articles . '.png'  ?>" alt="<?= $theArticle->articleName ?>">

        <!-- ouverture formulaire -->
        <form method="post" class="w-100 update mb-3 mb-lg-0 medium gold blackClover d-flex flex-column flex-lg-row justify-content-center align-items-center p-3" enctype="multipart/form-data">
            <!-- récupération picture -->
            <div class="w-100 form-group pt-2">
                <label for="picture" class="form-label">Oeuvre :</label>
                <div class="d-flex justify-content-center align-items-center">
                    <input class="form-control" type="file" id="picture" name="picture" accept="image/png" required>
                    <button type="submit" class="btn-update text-center blackClover ms-2"><img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="plume dorée"></button>
                </div>
                <p class="red little text-center"><?= $error['picture'] ?? '' ?></p>
            </div>
        </form>
    </div>
    <!-- fermeture formulaire -->
</div>