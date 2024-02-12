<?php

require_once '../vendor/autoload.php';

use App\Page;
$msg = false;
$page = new Page();

var_dump($page->session->get('user'));

if(!$page->session->has('user')) {
    header("Location: login.php");
    exit();
}

echo $page->render('profil.html.twig',[
    'msg' => $msg
]);
