<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EMAIL = $_POST["email"];
    $PASSWORD = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if (!empty($EMAIL) && !empty($PASSWORD) && !empty($confirmPassword)) {
        if ($PASSWORD === $confirmPassword) {
            $userData = [
                'email' => $EMAIL,
                'password' => password_hash($PASSWORD, PASSWORD_DEFAULT), 
                'role' => 1
            ];

            
            $page->insert('user', $userData);

            echo "Inscription réussie!";
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

echo $page->render('register.html.twig', []);
?>
