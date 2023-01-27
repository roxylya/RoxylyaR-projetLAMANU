<main class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="bgcgu d-flex flex-column justify-content-center align-items-center m-lg-5">
                <h1><span class="bdRenaissanceH1">C</span>onnexion </h1>
                <form method="post" class="connect my-5" enctype="multipart/form-data" novalidate>
                    <div class="d-lg-flex flex-wrap justify-content-around align-items-center pt-3">
                        <div class="form-group ">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="" pattern="" required>
                            <p class="error">Message d'alerte</p>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" value="" pattern="" required>
                            <p class="error" id="alertPassword1">Message d'alerte</p>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
                    </div>
                    <div class="pt-3 text-center">
                        <p> Pas encore inscrit ? C'est par <a href="/controllers/formCtrl.php">ici</a>.</p>
                    </div>
            </div>
            </form>
            <div class="text-center pt-3">
                <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
            </div>
        </div>
    </div>
</main>