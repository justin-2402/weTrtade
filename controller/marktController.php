<?php
require_once 'view/baseView.php';
require_once 'view/marktView.php';


$view = new baseView();
$marktView = new marktView();
$view->setSeitenName('markt');

$js = array('public/js/markt.js');
$css = array('public/css/markt.css');
$view->setCssLinksHtmlFormat($css);
$view->setJsLinksHtmlFormat($js);

echo $view->getTopBaseView();
echo $marktView->getMarktView();
echo $view->getBottomBaseView();
