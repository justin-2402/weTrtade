<?php
$request = $_SERVER['REQUEST_URI'];
$pathFromRoot = '';

switch ($request)
{
    case strpos($request, "$pathFromRoot/registrieren?"):
    case "/registrieren":
        require_once 'controller/registrierenController.php';require_once 'controller/registrierenController.php';
        break;
    case "$pathFromRoot/":
    case "$pathFromRoot/home":
        require_once 'controller/homeController.php';
        break;
   case strpos($request, "$pathFromRoot/ajax?emailCheck"):
        require_once 'ajaxPhp/ajaxEmailCheck.php';
        break;
    case "$pathFromRoot/profil":
        require_once 'controller/profilController.php';
        break;
    case "$pathFromRoot/markt":
        require_once 'controller/marktController.php';
        break;
    default:
        require_once 'controller/notFoundController.php';
        break;
}

