<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$errors = []; // Initialiser le tableau des erreurs

// Vérification formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email invalide";
    } elseif ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Les mots de passe ne correspondent pas.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%*?&]{6,}$/', $password)) {
        $errors['password'] = "Mot de passe incorrect";
    } else {
        if (!$page->checkEmailExists($email)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            try {
                $page->insertUser($email, $hashedPassword);
                // Redirection après une inscription réussie
                header("Location: register.php?email=" . urlencode($email));
                exit();
            } catch (\Exception $e) {
                $errors['database'] = $e->getMessage();
            }
        } else {
            $errors['email'] = "L'adresse email est déjà utilisée.";
        }
    }
}



    echo $page->render('register.html.twig', []);

    