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
    $listeIntervenants=[];
    foreach($listeIntervention as $inter) {
        $listeIntervenants[$inter['IDI']] = $page->GetIntervenantsFromIntervention($data);
    }

    
}



echo $page->render('profile.html.twig',[
    'msg' => $msg,
    'listeIntervention' => $listeIntervention,
    'listeIntervenants' => $listeIntervenants
]);
