<?php

$app->get('/registrations/:id/start', function ($id) use ($app) {
	echo "Start a registration";
});

$app->get('/registrations/:id/mark', function ($id) use ($app) {
	echo "Mark a registration";
});