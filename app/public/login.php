<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

if(isset($_POST['send'])){
    $user = $page->getUserByEmail([
        'email' => $_POST['email'],
    ]);

    

    if (!$user){$msg = "email ou mot de passe incorrect !";} 
    else {
        if (!password_verify($_POST['password'], $user['PASSWORD'])){
            $msg = "mauvais mot de passe ";
        }
        else{
            $page->session->add('user', $user);
            header('Location: profile.php');
        }
    }
}
echo $page->render('login.html.twig',[
    'msg' => $msg
]);
