<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = false;

    Header("Location: login.php");