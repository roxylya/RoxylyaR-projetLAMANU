<?php
define('REGEX_NAME', '^[a-zA-Z éèêë\'\-]{2,32}$');
define('REGEX_EMAIL', '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
define('REGEX_PASSWORD', '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$');
define('EXTENSION', ['image/jpeg', 'image/JPG', 'image/gif', 'image/png']);
