<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">B</span>ienvenue <?= $userConnected->pseudo ?> !</h1>
</div>
<p class="pt-2"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
<div class="box d-flex flex-lg-row flex-column justify-content-around align-items-center mt-3 p-3">
    <div class="actionUser p-3">
        <a href="/controllers/userAccount/profilAccountCtrl.php">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"> <img src="/public/assets/img/plume.png" alt="icône édition">Mes infos</div>
        </a>
        <a href="/controllers/userAccount/ordersUserCtrl.php">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/icons8-panier-en-osier-96.png" alt="">Mes achats</div>
        </a>
    </div>
    <img class="avatarProfil" src="/public/uploads/avatars/avatar_<?= $userConnected->id_users . '.' . $userConnected->extUserAvatar ?>" alt="avatarUser">
    <div class="lookUser p-5">
        <a href="/controllers/userAccount/dressingUserCtrl.php">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/armoire.png" alt="">Mon dressing</div>
        </a>
        <a href="/controllers/userAccount/galleryUserCtrl.php">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/tableau.png" alt="">Ma galerie</div>
        </a>
    </div>
</div>