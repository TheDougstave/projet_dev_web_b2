<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if(isset($_POST['send'])){
        var_dump($_POST);
   
        
        $page->insert('users', [
            'email' => $_POST["email"],
            'password' => md5($_POST["password"])
        ]);
    }

    echo $page->render('register.html.twig', []);

    