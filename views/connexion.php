<main class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="bgcgu d-flex flex-column m-lg-5">
                <div class="text-center ">
                    <h1><span class="bdRenaissanceH1">C</span>onnexion </h1>
                </div>

                <div class="pt-lg-5 pt-3">
                    <form method="post" class="m-3 p-3 my-lg-3 px-lg-5" enctype="multipart/form-data" novalidate>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="" pattern="" required>
                            <p>Message d'alerte</p>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" value="" pattern="" required>
                            <p id="alertPassword1">Message d'alerte</p>
                        </div>
            
                        <div class="form-group pt-3 text-center">
                            <button type="submit" id="submit" class="btn btn-default">Envoyer</button>
                        </div>

                       <p> Pas encore inscrit ? C'est par <a href="/controllers/formCtrl.php">ici</a>.</p>
                    </form>
                    <div class="text-center py-3">
                        <a href="#"><img class="chandlierReturn" title="Retour en haut" src="/public/assets/img/chandelier1.png" alt="chandelier"></a>
                    </div>
                </div>
            </div>
</main>