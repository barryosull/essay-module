<?php

/* Modules */
$app->post('/modules', function () use ($input) {
    echo new ResponseJson($input);
});

$app->get('/modules/:id', function ($id) use ($app) {
	$module = new stdClass();
	$module->id = $id;

	echo new ResponseJson($module);
});

$app->post('/modules/:id/upload', function ($id) use ($input) {
	echo new ResponseJson();
});

$app->get('/modules/:id/import', function ($id) use ($input) {
	echo new ResponseJson();
});

$app->get('/modules/:id/preview_url', function ($id) use ($input) {
	echo new ResponseJson('http://google.com');
});

/* Registrations */
$app->post('/registrations', function () use ($input) {
    echo new ResponseJson( new Registration($input->id) );
});

$app->get('/registrations/:id', function ($id) use ($app) {
	echo new ResponseJson( new Registration($id) );
});

$app->put('/registrations/:id/reset', function ($id) use ($app) {
	echo new ResponseJson();
});

$app->get('/registrations/:id/launch_url', function ($id) use ($app) {
	echo new ResponseJson("http://bing.com");
});
