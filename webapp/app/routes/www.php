<?php



$loader = new Twig_Loader_Filesystem(APP_PATH.'/views/');
$twig = new Twig_Environment($loader);

$app->get('/registrations/:id/start', function ($id) use ($app, $twig) {
	echo $twig->render('module.php');
});

$app->get('/registrations/:id/mark', function ($id) use ($app) {
	echo "Mark a registration";
});