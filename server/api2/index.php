<?php

if (file_exists('../../vendor/autoload.php')) {
    require '../../vendor/autoload.php';
}

ignore_user_abort(true);
$input = json_decode($_POST["json"]);
print_r($_GET);
print_r($input);
$logger = new Logger();
$logger->write(serialize($input) . " " . date("dd mm YY / H:i:s"));
echo "Testing";
