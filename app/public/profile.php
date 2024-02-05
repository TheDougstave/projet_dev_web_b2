<?php

require_once '../vendor/autoload.php';

use App\Page;
$msg = false;
$page = new Page();

var_dump($page->session->get('user'));

echo $page->render('profil.html.twig',[
    'msg' => $msg
]);
