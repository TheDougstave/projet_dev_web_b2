<?php
    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations de connexion (à remplacer par votre logique de vérification)
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si les informations de connexion sont correctes (à remplacer par votre logique de vérification)
    if (verifierConnexion($email, $password)) {
        // Rediriger vers la page d'accueil si la connexion est réussie
        header("Location: accueil.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        
        $messageErreur = "Adresse email ou mot de passe incorrect.";
    }
}


function verifierConnexion($email, $password) {
    return ($email === "utilisateur@example.com" && $password === "motdepasse");
}



echo $page->render('accueil.html.twig',[]);
