<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = ''; // Initialisez la variable de message d'erreur à une chaîne vide

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EMAIL = $_POST["email"];
    $PASSWORD = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

// Vérifie si l'utilisateur existe déjà
if ($page->userExistsByEmail($EMAIL)) {
    $msg = "Cet email est déjà utilisé. Veuillez utiliser un autre email.";
} else {
    if (!empty($EMAIL) && !empty($PASSWORD) && !empty($confirmPassword)) {
        if ($PASSWORD === $confirmPassword) {
            $userData = [
                'email' => $EMAIL,
                'password' => password_hash($PASSWORD, PASSWORD_DEFAULT), 
                'role' => 1
            ];

            $page->insert('user', $userData);

            $msg = "Inscription réussie!";
        } else {
            $msg = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $msg = "Veuillez remplir tous les champs.";
        }
    }
}
echo $page->render('register.html.twig', ['msg' => $msg]); // Transmettez le message d'erreur au modèle Twig
?>
