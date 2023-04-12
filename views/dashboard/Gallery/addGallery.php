<p class="pt-3"><?= $message ?? '' ?></p>
<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">A</span>jouter sur la <span class="bdRenaissanceH1 blue ">G</span>alerie</h1>
<h2 class="dashboardDisplay text-center fondamento blue medium">Accessible à partir de 1110px de largeur d'écran ! </h2>
<div class="modeOff m-0 p-0">
    <!-- nav dashboard start -->
    <ul class="navDashboard d-flex justify-content-center align-items-center m-0  ms-0 ps-0 p-0">
        <li class="bgBlue">
            <a class="gold " href="/admin-les-inscrits.html">Inscrits</a>
        </li>
        <li class="bgBlue">
            <a class="gold" href="/admin-catalogue.html">Catalogue</a>
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
    <form method="post" class="connect my-3 medium gold fondamento" enctype="multipart/form-data" novalidate>
        <div class="d-flex flex-column justify-content-around align-items-center pt-3 px-1 px-lg-0">

            <!-- name -->
            <div class="w-100 form-group">
                <label for="name">Titre :</label>
                <input type="text" class="form-control" id="name" minlength="3" maxlength="50" name="name" value="<?= $name ?? '' ?>" required>
                <p class="red little text-center"><?= $error['name'] ?? '' ?></p>
            </div>

            <!-- types -->
            <div class="w-100 form-group">
                <label for="id_types">Catégorie :</label>
                <select class="form-select" name="id_types" id="id_types" aria-label="Catégorie">
                    <option selected>Choisissez</option>
                    <?php foreach ($types as $type) { ?>
                        <option value="<?= $type->id_types ?>"><?= $type->name ?></option>
                    <?php } ?>
                </select>
                <p class="red little text-center"><?= $error['id_types'] ?? '' ?></p>
            </div>

            <!-- récupération picture -->
            <div class="w-100 form-group">
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
</div>