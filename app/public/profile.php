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
    $email = $user['EMAIL'];

    $data = [':idu' => $idu];
    $role = $page->getRole($data);
    if($role == "Standardiste" || $role == "Admin"){
        $listeInterventionancien = $page->GetInterventionJustIDI();
    }
    else{
        $listeInterventionancien = $page->GetListInterventions($data);
    }
    $listeIntervenants=[];
    $listeIntervention = [];
    foreach($listeInterventionancien as $inter) {
        $data = [':idi' => $inter['IDI']];
        $listeIntervention[$inter['IDI']] = $page->getIntervention($data);
        $listeIntervenants[$inter['IDI']] = $page->GetIntervenantsFromInterventionIDI($data);
    }
    $data = [':idu' => $idu];
    
    
}



echo $page->render('profile.html.twig',[
    'msg' => $msg,
    'listeIntervention' => $listeIntervention,
    'listeIntervenants' => $listeIntervenants,
    'role' => $role
]);
