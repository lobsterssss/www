<?php

require_once __DIR__.'/router.php';
include __DIR__.'/database/database.php';

// components
include __DIR__.'/component/nav.php';
include __DIR__.'/component/head.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/kookproject', 'views/index.php');

get('/kookproject/medicijnen', 'views/drugs.php');

get('/kookproject/contact', path_to_include: 'views/contact.php');

get('/kookproject/schedule', path_to_include: 'views/schedule.php');

get('/kookproject/about', path_to_include: 'views/about.php');


// ##################################################
// ##################################################
// ##################################################
// Route that will use POST data
// post('/user', '/api/save_user');



// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/error/404.php');
