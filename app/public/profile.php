<?php

require_once '../vendor/autoload.php';

use App\Page;
use App\Session;
$session = new Session();

$msg = false;
$page = new Page();

//var_dump($page->session->get('user'));

if(!$session->isConnected()){
    header("Location: login.php");
    exit();
}

echo $page->render('profile.html.twig',[
    'msg' => $msg
]);
