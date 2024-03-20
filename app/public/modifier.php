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
    $idi = $_GET['idi'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $NOM = $_POST['nom'];
        $DATE = $_POST['date'];
        $EMAIL = $_POST['email'];
        $DETAIL = $_POST['detail'];
        $ADRESSE = $_POST['adresse'];
        $INTERVENANTS = $_POST['intervenant'];
        $INTERVENANTS = preg_split('/\s+/', $INTERVENANTS, -1, PREG_SPLIT_NO_EMPTY);
        $URGENCE = $_POST['urgence'];
        $STATUT = $_POST['statut'];

        $data = [':email' =>$EMAIL];
        $user = $page->GetUserByEmail($data);
        if($user!=NULL){
            $idu = $user['IDU'];
            $data = [':idi' => $idi];
            $data2 = [
                ':date' => $DATE,
                ':detail' => $DETAIL,
                ':nom' => $NOM,
                ':adresse' => $ADRESSE,
                ':urgence' => $URGENCE,
                ':statut' => $STATUT
            ];
            $page->deleteIntervention($data);
            
            $page->insertIntervention($data2);
            $idi = $page->getMaxIDI();
            $data = [':idi' => $idi, ':idu' =>$idu];
            $page->insertIntervient($data);

            foreach($INTERVENANTS as $intervenant){
                $data = [':email' => $intervenant,];
                $user = $page->GetUserByEmail($data); 
                if($user!=NULL){
                    $idu = $user['IDU'];
                    $data = [':idu' => $idu, ':idi' => $idi];
                    $page->insertIntervient($data);
                }
            }
        }
        else{
            $msg = "L'Email est attaché à aucun compte.";
        }
    }
    
    $user = $_SESSION['user'];
    $idu = $user['IDU']; //faudra modif pour que sa deco si il a pas acces
    

    $data = [':idi' => $idi];
    $info_base_inter = $page->GetIntervention($data);
    
    $intervenants = $page->GetIntervenantsFromInterventionIDI($data);
    
    $data = [':idu' => $idu];
    $role = $page->getRole($data);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        header('location:profile.php');
    }
}

echo $page->render('modifier.html.twig',[
  'info_base_inter' => $info_base_inter,
  'intervenants' => $intervenants,
  'idi' => $idi,
  'role' => $role
]);