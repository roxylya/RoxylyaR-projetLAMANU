<h1 class="blackClover blue pb-3"> <span class="bdRenaissanceH1 blue ">A</span>jouter un<span class="bdRenaissanceH1 blue ">C</span>ommentaire</h1>
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
    <form method="post" class="connect mt-3 mb-5 medium gold fondamento" novalidate>
        <div class="d-flex flex-column justify-content-around align-items-center pt-3 px-1 px-lg-0">

            <!-- notice -->
            <div class="w-100 form-group pt-2">
                <label for="notice" class="form-label">Description</label>
                <textarea class="form-control notice" name="notice" id="notice" rows="10" minlength="5" maxlength="300"></textarea>
                <p class="red little text-center"><?= $error['notice'] ?? '' ?></p>
            </div>

            <!-- bouton pour envoyer le formulaire -->
            <div class="form-group text-center py-2 mt-3">
                <button type="submit" id="submit" class="btn">Envoyer</button>
            </div>
        </div>
    </form>
</div>