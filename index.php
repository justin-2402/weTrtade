<?php
$request = $_SERVER['REQUEST_URI'];
$pathFromRoot = '';

switch ($request)
{
    case "$pathFromRoot/":
    case "$pathFromRoot/home":
        require_once 'controller/homeController.php';
        break;
    case str_contains($request, "$pathFromRoot/registrieren?"):
    case "$pathFromRoot/registrieren":
        require_once 'controller/registrierenController.php';
        break;
    case str_contains($request, "$pathFromRoot/ajax?emailCheck"):
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

