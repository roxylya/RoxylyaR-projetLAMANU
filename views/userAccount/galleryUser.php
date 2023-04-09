<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>a galerie</h1>
</div>

<div class="gallery d-flex flex-wrap justify-content-around align-items-center pt-2 mb-2">
    <?php foreach ($galleries as $gallery) { ?>
        <!-- article start -->
        <div class="box bgBlue d-flex flex-column justify-content-center align-items-center p-3 m-md-2 my-2">
            <!-- titre de l'article -->
            <h2 class="gold blackClover text-center medium"><?= $gallery->galleryName ?></h2>
            <p class="little gold fondamento"> <?= $gallery->pseudo ?> <span class="blue">|</span> <?= date('d-m-Y', strtotime($gallery->created_at)) ?><span class="blue">|</span> <?= $gallery->typeName ?></p>
            <!-- image de l'article -->
            <img class="pt-4" src="/public/uploads/gallery/<?= $gallery->typeName . '_' . $gallery->id_galleries . '.png'  ?>" alt="fresque <?= $gallery->galleryName ?>">
        </div>
        <!-- article start --> <?php } ?>
</div>
