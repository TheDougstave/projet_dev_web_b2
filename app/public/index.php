<?php

require_once '../vendor/autoload.php';

use App\Page;

$twig = new Page();
$msg = ''; // Assurez-vous que $msg est défini avant l'utilisation

if (isset($_POST['send'])) {
    var_dump($_POST);

    $user = $twig->getUserbyEmail([
        'email' => $_POST['email']
    ]);

    var_dump($user);

    if (!$user) {
        $msg = "mauvais mdp ou email";
    } else {
        if (!password_verify($_POST["password"], $user["password"])) {
            $msg = "mauvais mdp ou email";
        } else {
            // on se connecte à la page de profile et on affiche l'email
            session_start();

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: profile.php");
            exit();
        }
    }
}

header("Location: accueil.html.twig");
exit();
