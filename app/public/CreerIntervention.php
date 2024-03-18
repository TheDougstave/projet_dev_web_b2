<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

// Vérification formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $EMAIL= $_POST['email'];
    $DATE = $_POST['date'];
    $DETAIL = $_POST['detail'];
    $NOM = $_POST['nom'];
    $ADRESSE = $_POST['adresse'];
    $INTERVENANT = $_POST['intervenant'];

    
    $connexion = mysqli_connect('localhost:8080', 'root', '', 'b2-paris');

    // Vérification de la connexion
    if (!$connexion) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Préparation de la requête SQL
    $query = "INSERT INTO intervention (email, date, detail, nom, adresse, intervenant) 
              VALUES ('$EMAIL', '$DATE', '$DETAIL', '$NOM', '$ADRESSE', '$INTERVENANT')";

    // Exécution de la requête SQL
    $result = mysqli_query($connexion, $query);

    // Vérification de l'exécution de la requête
    if ($result) {
        $msg = "L'intervention a été créée avec succès.";
    } else {
        $msg = "Erreur lors de la création de l'intervention : " . mysqli_error($connexion);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
} else {
    // Si le formulaire n'a pas été soumis, afficher un message d'erreur
    echo "Le formulaire n'a pas été soumis.";
}

// Rendu de la page avec Twig
echo $page->render('CreerIntervention.html.twig', [
    'msg' => $msg
]);

?>


