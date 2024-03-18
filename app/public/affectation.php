<?php

require_once '../vendor/autoload.php';

use App\Page;
use App\Session;
$session = new Session();

$msg = false;
$page = new Page();


if(!$session->isConnected()){
    header("Location: login.php");
    exit();
}
else{
   

    
    
}

echo $page->render('affectation.html.twig',[
  
]);

