<?php
session_start();
require_once __DIR__.'/router.php';
include __DIR__.'/database/database.php';

// components
include __DIR__.'/component/nav.php';
include __DIR__.'/component/footer.php';
include __DIR__.'/component/head.php';
include __DIR__.'/component/patient.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/kookproject', '/views/index.php');

get('/kookproject/contact', '/views/contact.php');

get('/kookproject/about', '/views/about.php');

if(!isset($_SESSION["user"])):
    get('/kookproject/login', 'views/login.php');
    post('/kookproject/login', 'php/login.php');

    get('/kookproject/register', 'views/register_user.php');
    post('/kookproject/register', 'php/register_user.php');

else:
    get('/kookproject/settings', 'views/settings.php');
    post('/kookproject/settings', 'php/settings.php');

    get('/kookproject/patienten', 'views/patienten.php');

    get('/kookproject/register', 'component/klanten/register_klant.php');
    post('/kookproject/register', 'php/register_klant.php');

    // get('/$Klant_ID/edit', 'component/klanten/edit_klant .php');
    // post('/$Klant_ID/edit', 'view/register_klant.php');

    get('/kookproject/delete/$Klant_ID', 'component/klanten/delete_klant.php');
    post('/kookproject/delete/$Klant_ID', 'php/klanten/delete_klant.php');

    get('/kookproject/patienten_lijst', 'component/klanten/klanten_list.php');

    post('/kookproject/api/send_feedback', 'php/api/delete_klant.php');


    get('/kookproject/logout', '/php/logout.php');
endif;


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
