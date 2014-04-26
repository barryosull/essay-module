<?php

require '../vendor/autoload.php';

define('APP_PATH', '../app');

//Autoload models
spl_autoload_register(function ($class) {
    include '../app/models/' . $class . '.php';
});

//Load the config
if (!defined("APP_ENV")) {
	$environment = (getenv("APP_ENV")) ?: "development";
	define("APP_ENV", $environment);
}

include '../app/configs/' . APP_ENV . '.php';
