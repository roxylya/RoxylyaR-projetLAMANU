<main class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="bgcgu d-flex flex-column justify-content-center align-items-center m-lg-5">
                <h1><span class="bdRenaissanceH1">I</span>nscription </h1>
                <form method="post" class="createAccount my-5" enctype="multipart/form-data" novalidate>
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
                        <div class="form-group col-lg-5">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="" pattern="" required>
                            <p class="error">Message d'alerte</p>
                        </div>
                        <div class="form-group col-lg-5 ">
                            <label for="firstname">Pseudo RR:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" pattern="" required>
                            <p class="error">Message d'alerte</p>
                        </div>
                    </div>
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-3">
                        <div class="form-group col-lg-5">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" value="" pattern="" required>
                            <p class="error" id="alertPassword1">Message d'alerte</p>
                        </div>
                        <div class="form-group col-lg-5 ">
                            <label for="passwordConfirm">Confirmer mot de passe :</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="" pattern="" required>
                            <p class="error" id="alertPassword2">Message d'alerte</p>
                        </div>
                    </div>

                    <!--    REGEX PASSWORD : min 8, 1 maj, 1 min, 1 chiffre, 1 caractère spécial-->
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-lg-2">
                        <div class="form-group col-lg-11">
                            <label for="avatar" class="form-label">Avatar :</label>
                            <input class="form-control" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required>
                            <p class="error">Message d'alerte</p>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" id="submit" class="btn">Envoyer</button>
                    </div>

                </form>
                <div class="text-center">
                    <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                </div>
            </div>
        </div>
    </div>
</main>