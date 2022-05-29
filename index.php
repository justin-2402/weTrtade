<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request)
{
    case strpos($request, "/registrieren?"):
    case "/registrieren":
        require_once 'controller/registrierenController.php';require_once 'controller/registrierenController.php';
        break;
    case "/":
    case "/home":
        require_once 'controller/homeController.php';
        break;
    case strpos($request, "/ajax?emailCheck"):
        require_once 'ajaxPhp/ajaxEmailCheck.php';
        break;
    case "/profil":
        require_once 'controller/profilController.php';
        break;
    case "/markt":
        require_once 'controller/marktController.php';
        break;
    default:
        require_once 'controller/notFoundController.php';
        break;
}

