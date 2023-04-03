<?php

// pour vérifier qu'une image est en version portrait ou paysage :
function isPortrait($to)
{
    $type = mime_content_type($to);
    switch ($type) {
        case 'image/gif':
            $gd_original = imagecreatefromgif($to);

            break;

        case 'image/png':
            $gd_original = imagecreatefrompng($to);

            break;

        case 'image/jpg':
            $gd_original = imagecreatefromjpeg($to);

            break;

        case 'image/JPG':
            $gd_original = imagecreatefromjpeg($to);

            break;

        case 'image/jpeg':
            $gd_original = imagecreatefromjpeg($to);

            break;
    }

    $height_original = imagesy($gd_original);
    $width_original = imagesx($gd_original);
    $isPortrait = ($height_original > $width_original) ? true : false;

    return $isPortrait;
}
