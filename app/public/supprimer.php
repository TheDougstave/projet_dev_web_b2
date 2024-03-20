<?php

require_once '../vendor/autoload.php';

use App\Page;
use App\Session;
$session = new Session();

$msg = false;
$page = new Page();


if(!$session->isConnected() || !isset($_GET["idi"])){
    //header("Location: profile.php"); //on revient au profile juste car y'a pas d'idi, si il est deco aussi car il ira au profile qui le returnera sur le login
    //  exit();
}
else{
    if(!$session->isConnected() || !isset($_GET["idi"])){
        header("Location: profile.php"); //on revient au profile juste car y'a pas d'idi, si il est deco aussi car il ira au profile qui le returnera sur le login
        exit();
    }
    $idi = $_GET['idi'];
    $data =[':idi' => $idi];
    $page->deleteIntervention($data);
    header('location:profile.php');

}

echo $page->render('supprimer.html.twig',[

]);