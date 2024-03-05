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
else{
    $user = $_SESSION['user'];
    
    $idu = $user['IDU'];

    $data = [
        ':idu' => $idu,
    ];

    $listeIntervention = $page->GetUserInterventions($data);
    //foreach($listeIntervention as $intervention){
    
}



echo $page->render('profile.html.twig',[
    'msg' => $msg,
    'listeIntervention' => $listeIntervention
]);
