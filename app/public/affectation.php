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
   $users = $page->getAllUsers();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $role = $_POST["role"];
    $page->modifierRole($role, $_GET['idu']);
  }
  $users = $page->getAllUsers();
    
}

echo $page->render('affectation.html.twig',[
  'users' => $users,
]);
