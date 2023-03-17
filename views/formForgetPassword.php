<main class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column justify-content-center align-items-center mt-5 ">
                <h1 class="text-center"><span class="bdRenaissanceH2">M</span>ot de <span class="bdRenaissanceH2">P</span>asse <br><span class="bdRenaissanceH2">O</span>ublié</h1>
                <p class="py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
                <form method="post" class="connect my-5" enctype="multipart/form-data" novalidate>
                    <div class="d-md-flex flex-column justify-content-around align-items-center pt-3">
                        <div class="form-group ">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" pattern="<?= REGEX_EMAIL ?>" required>
                        </div>
                        <p class="error text-center pt-2" id="alertPassword1"><?= $error['password'] ?? $error['email'] ?? '' ?></p>
                        <div class="form-group text-center">
                            <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
                        </div>
                        <p class="little pt-3"> Pas encore inscrit ? C'est par <a href="/controllers/formSubscribeCtrl.php">ici</a>.</p>
                    </div>
                </form>
            </div>
            <div class="text-center pt-3">
                <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
            </div>
        </div>
    </div>
</main>