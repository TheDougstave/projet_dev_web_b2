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
    $user = $_SESSION['user'];
    $idu = $user['IDU']; //faudra modif pour que sa deco si il a pas acces
    
    $idi = $_GET['idi'];

    $data = [':idi' => $idi];
    $info_base_inter = $page->GetIntervention($data);
    
    $intervenants = $page->GetIntervenantsFromInterventionIDI($data);
    
}

echo $page->render('show.html.twig',[
  'info_base_inter' => $info_base_inter,
  'intervenants' => $intervenants,
]);