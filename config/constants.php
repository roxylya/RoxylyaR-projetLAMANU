<?php
// informations de connexion à la base données :
define("DSN",'mysql:dbname=roxylyaProjetEcole;host=127.0.0.1');
define("USER",'roxylya_user');
define("PASSWORD",'ON.lbQ]ygAm!!X/v');

// REGEX
define('REGEX_PSEUDO', '^[\w\d\-\.]{3,25}$');
define('REGEX_EMAIL', '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
define('REGEX_PASSWORD', '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$');
define('EXTENSION', ['image/png', 'image/jpeg']);
define('EXTENSION_PNG', ['image/png']);
define('MAX_FILESIZE',5*1024*1024);
define('MAX_FILESIZE_PICTURE',2*1024*1024);
define('LOCATION_UPLOAD', $_SERVER['DOCUMENT_ROOT'] . '/public/uploads');