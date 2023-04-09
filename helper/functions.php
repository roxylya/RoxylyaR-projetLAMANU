<?php

// pour vérifier qu'une image est en version portrait ou paysage :
function isPortrait($to)
{
    $type = mime_content_type($to);
    switch ($type) {

        case 'image/png':
            $gd_original = imagecreatefrompng($to);

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

// pour récupérer la hauteur de l'image originale :

function getHeightOriginal($to)
{
    $type = mime_content_type($to);
    switch ($type) {

        case 'image/png':
            $gd_original = imagecreatefrompng($to);

            break;

        case 'image/jpeg':
            $gd_original = imagecreatefromjpeg($to);

            break;
    }

    $height_original = imagesy($gd_original);

    return $height_original;
}

// pour récupérer la largeur de l'image originale :

function getWidthOriginal($to)
{
    $type = mime_content_type($to);
    switch ($type) {

        case 'image/png':
            $gd_original = imagecreatefrompng($to);

            break;

        case 'image/jpeg':
            $gd_original = imagecreatefromjpeg($to);

            break;
    }

    $width_original = imagesx($gd_original);

    return $width_original;
}


  //  je redimensionne l'image à 400px de large max :  
//  
// if ($type == 'image/png') {
//     $gd_original = imagecreatefrompng($to);
//     $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
//     $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
//     imagepng($gd_scaled, $to_scaled);
//     // $height_scaled = imagesy($gd_scaled);
//     // $y_cropped = ($height_scaled - $size) / 2;
//     // $width_scaled = imagesx($gd_scaled);
//     // $x_cropped = ($width_scaled - $size) / 2;
//     // if ($height_scaled > $width_scaled) {
//     //     // portrait :
//     //     imagecrop($gd_scaled, ['x' => 0, 'y' => $y_cropped, 'width' => $size, 'height' => $size]);
//     // } else {
//     //     // paysage :
//     //     imagecrop($gd_scaled, ['x' => $x_cropped, 'y' => 0, 'width' => $size, 'height' => $size]);
//     // }
//     // imagepng($gd_scaled, $to_scaled, 85);
// } elseif ($type == 'image/jpeg') {
//     $gd_original = imagecreatefromjpeg($to);
//     $gd_scaled = imagescale($gd_original, $width_scaled, -1, IMG_BICUBIC);
//     $to_scaled = LOCATION_UPLOAD . '/avatars/' . $avatarName;
//     imagejpeg($gd_scaled, $to_scaled,85);
//     // $height_scaled = imagesy($gd_scaled);
//     // $y_cropped = ($height_scaled - $size) / 2;
//     // $width_scaled = imagesx($gd_scaled);
//     // $x_cropped = ($width_scaled - $size) / 2;
//     // if (isPortrait($to)) {
//     //     // portrait :
//     //     $gd_cropped = imagecrop($gd_scaled, ['x' => 0, 'y' => $y_cropped, 'width' => $size, 'height' => $size]);
//     // } else {
//     //     // paysage :
//     //     $gd_cropped =  imagecrop($gd_scaled, ['x' => $x_cropped, 'y' => 0, 'width' => $size, 'height' => $size]);
//     // }
//     // imagejpeg($gd_cropped, $to_scaled, 85);
// } else {
//     $message = "Il y a un soucis. Mais où?";
//     Session::setMessage($message);
//     header('location: /erreur.html');
//     die;
// }


// limiter le nombre de caractères affiché dans le dashboard :



function stopText($notice)
{
    if (strlen($notice) > 60) {
        $notice = substr($notice, 0, 60);
        $position_espace = strrpos($notice, " ");
        $text = substr($notice, 0, $position_espace);
        $notice = $text . "...";
    };
    return $notice;
}