<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">B</span>ienvenue <?= $user->pseudo ?>!</h1>
</div>
<p class="pt-2"><?= $message ?? '' ?></p>
<div class="box bgBlue medium d-flex flex-lg-row flex-column justify-content-around align-items-center mt-3 mb-5 p-3 p-md-5">
    <div class="actionUser p-3">
        <a href="/mon-compte-mes-informations.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"> <img src="/public/assets/img/quill-dessinant-une-lignegold.png" alt="icône édition">Mes infos</div>
        </a>
        <a href="/mon-compte-mes-achats.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/facture.png" alt="icône facture">Mes achats</div>
        </a>
        <a href="/mon-compte-je-commande.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/panier-en-osier.png" alt="icône panier en osier">Commander</div>
        </a>
    </div>
    <img class="avatarProfil" src="/public/uploads/avatars/avatar_<?= $user->id_users . '.' . $user->extUserAvatar ?>?<?= rand(1,2000) ?>" alt="avatarUser">
    <div class="lookUser p-3">
        <a href="/mon-compte-mon-dressing.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/penderie.png" alt="icône penderie">Mon dressing</div>
        </a>
        <a href="/mon-compte-ma-galerie.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/galerie-dart.png" alt="icône galerie">Ma galerie</div>
        </a>   
        <?php if($user->id_roles === 1 || $user->id_roles === 2){ ?>
        <a href="/admin.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/admin.png" alt="icône admin">Dashboard</div>
        </a>
    <?php } else { ?>
        <a href="/mon-compte-mes-messages.html">
            <div class="btnUserAccount d-flex justify-content-around align-items-center"><img src="/public/assets/img/message.png" alt="icône message">Mes Messages</div>
        </a>
   <?php } ?>
    </div>
</div>