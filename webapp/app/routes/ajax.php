<?php

/* Registrations */
$app->post('/registrations/:id/submit', function ($id) use ($input) {
    echo new ResponseJson();
});

$app->post('/registrations/:id/answer', function ($id) use ($input) {
	echo new ResponseJson();
});

$app->get('/registrations/:id/submit', function ($id) {
	echo new ResponseJson();
});