<p class="pt-3"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">A</span>jouter sur le <span class="bdRenaissanceH1 blue ">C</span>atalogue</h1>
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
<form method="post" class="connect mt-3 mb-5 medium gold fondamento" enctype="multipart/form-data" novalidate>
    <div class="d-flex flex-column justify-content-around align-items-center pt-3 px-1 px-lg-0">

        <!-- name -->
        <div class="w-100 form-group pt-2">
            <label for="name">Titre :</label>
            <input type="text" class="form-control" id="name" minlength="3" maxlength="50" name="name" value="<?= $name ?? '' ?>" required>
            <p class="red little text-center"><?= $error['name'] ?? '' ?></p>
        </div>

        <!-- categories -->
        <div class="w-100 form-group pt-2">
            <label for="id_categories">Catégorie :</label>
            <select class="form-select" name="id_categories" id="id_categories" aria-label="Catégorie">
                <option selected>Choisissez</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->id_categories ?>"><?= $category->name ?></option>
                <?php } ?>
            </select>
            <p class="red little text-center"><?= $error['id_categories'] ?? '' ?></p>
        </div>

        <!-- Resume -->
        <div class="w-100 form-group pt-2">
            <label for="resume" class="form-label">Description</label>
            <textarea class="form-control resume" name="resume" id="resume" rows="3" minlength="30" maxlength="180" value="<?= $resume ?? '' ?>"></textarea>
            <p class="red little text-center"><?= $error['resume'] ?? '' ?></p>
        </div>

        <!-- récupération picture -->
        <div class="w-100 form-group pt-2">
            <label for="picture" class="form-label">Oeuvre :</label>
            <input class="form-control" type="file" id="picture" name="picture" accept="image/png" required>
            <p class="red little text-center"><?= $error['picture'] ?? '' ?></p>
        </div>

        <!-- bouton pour envoyer le formulaire -->
        <div class="form-group text-center py-2 mt-3">
            <button type="submit" id="submit" class="btn">Envoyer</button>
        </div>
    </div>
</form>