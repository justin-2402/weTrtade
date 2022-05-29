<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request)
{
    default:
        require_once '../controller/notFoundController.php';
        break;
}