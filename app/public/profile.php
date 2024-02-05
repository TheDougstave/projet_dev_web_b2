<?php

require_once '../vendor/autoload.php';

use App\Page;

$twig = new Page();

var_dump($page->$session->get('user'));
