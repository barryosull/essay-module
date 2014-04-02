<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require '../vendor/autoload.php';

require_once('../app/Registration.php');
require_once('../app/ResponseJson.php');
require_once('../app/ResponseJsonError.php');

$app = new \Slim\Slim();
$input = json_decode($app->request->getBody());

//Load the correct routes
$host_parts = explode('.', $app->request->getHost());
$sub_domain = $host_parts[0];
require "../app/routes/$sub_domain.php";

$app->run();