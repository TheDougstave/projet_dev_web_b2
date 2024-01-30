<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $twig = new Page();



    if(isset($_POST['send'])){
        var_dump($_POST);

        $user = $page->getUserbyEmail([
            'email'=> $_POST['email']
        ]);
        var_dump($user);
        if(!$user){
            $msg ="mauvais mdp ou email";
        }else{
            if(!password_verify($_POST["password"], $user["password"])){
                $msg = "mauvais mdp ou email";
            }else{
                //on se co a la page de profile et on affiche l'email
            }
        }
    }
    echo $twig->render('index.html.twig', [
        'msg' => $msg
    ]);