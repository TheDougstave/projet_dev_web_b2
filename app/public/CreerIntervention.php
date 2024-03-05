<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

// Vérification formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $urgence = $_POST['urgence'];
    $typedintervention = $_POST['typedintervention'];
    $details = $_POST['details'];
    $intervenants = $_POST['intervenant'];



    // Vérification de la connexion
    if (!$connexion) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Préparation des données pour l'insertion
    $data = [
        ':nom' => $nom,
        ':adresse' => $adresse,
        ':email' => $email,
        ':date' => $date,
        ':heure' => $heure,
        ':urgence' => $urgence,
        ':typedintervention' => $typedintervention,
        ':details' => $details
    ];

    // Utilisation de la fonction insert
    $page->insert('intervention', $data);

    // Vérification de l'exécution de la requête
    if ($result) {
        $msg = "L'intervention a été créée avec succès.";
    } else {
        $msg = "Erreur lors de la récupération des données de l'annonce.";
    }
}    else {
    // Si le formulaire n'a pas été soumis, afficher un message d'erreur
    echo "Le formulaire n'a pas été soumis.";
}
echo $page->render('CreerIntervention.html.twig', [
    'msg' => $msg
]);



?>
