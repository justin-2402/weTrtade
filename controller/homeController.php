<?php
require_once 'view/baseView.php';
require_once 'view/homeView.php';


$baseView = new baseView();
$homeView = new homeView();
$baseView->setSeitenName('home');


echo $baseView->getTopBaseView();
echo $homeView->getHomeContent();
echo $baseView->getBottomBaseView();
