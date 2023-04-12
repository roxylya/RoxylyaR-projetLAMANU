<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>odifier un <span class="bdRenaissanceH1">M</span>essage</h1>
</div>
<p class="pt-2 fondamento medium blue"><?= $message ?? '' ?></p>

    <div class="w-50 d-flex bgBlue formUpdate flex-column justify-content-center align-items-start">
        <div class="w-100 d-flex flex-lg-row flex-column justify-content-center align-items-center">
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