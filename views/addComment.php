<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">L</span>ivre d' <span class="bdRenaissanceH1">O</span>r</h1>
</div>
<div class="w-75 d-flex justify-content-around align-items-center">
    <form method="post" class="w-100 connect mt-3 mb-5 medium gold fondamento" novalidate>
        <div class="w-100 d-flex flex-column justify-content-around align-items-center pt-3 px-1 px-lg-0">

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