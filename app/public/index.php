<?php

    require_once('../classes/Twig.php');

    $twig = new Twig();

    echo $twig->render('index.html.twig', ['name' => 'Fabien']);