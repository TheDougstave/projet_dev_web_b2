<?php
require_once '../vendor/autoload.php';

use App\Session;

$session =new Session();

if(!$session->isConnected()){
    header('Location: login.php');
    exit();
}

$session->destroy();
header("Location: login.php");