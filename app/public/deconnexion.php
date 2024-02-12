<?php




use App\Page;
    
    $page = new Page();

session_destroy();


Header("Location : login.php");