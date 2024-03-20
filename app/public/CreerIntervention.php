<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;


// Vérification formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {            
    $NOM = $_POST['nom']; // Vous pouvez ajouter une validation du nom si nécessaire
    $DATE = $_POST['date']; // Vous pouvez ajouter une validation de date si nécessaire
    $EMAIL = $_POST['email'];
    $DETAIL = $_POST['detail']; // Vous pouvez ajouter une validation du détail si nécessaire
    $ADRESSE = $_POST['adresse']; // Vous pouvez ajouter une validation de l'adresse si nécessaire
    $URGENCE = 1;
    $STATUT = 1;
    $INTERVENANTS = $_POST['intervenant'];
    $INTERVENANTS = preg_split('/\s+/', $INTERVENANTS, -1, PREG_SPLIT_NO_EMPTY);

    $data = [':email' =>$EMAIL];
    $user = $page->GetUserByEmail($data);
    if($user!=NULL){
        $idu = $user['IDU'];
        $data = [
            ':date' => $DATE,
            ':detail' => $DETAIL,
            ':nom' => $NOM,
            ':adresse' => $ADRESSE,
            ':urgence' => $URGENCE,
            ':statut' => $STATUT
        ];
        $page->insertIntervention($data);
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

// Rendu de la page avec Twig
echo $page->render('CreerIntervention.html.twig', [
    'msg' => $msg
]);

// Gestion des erreurs de connexion à la base de données
if (isset($connexion) && !$connexion) {
    die("Erreur de connexion à la base de données : " . $connexion->errorInfo());
}

?>

