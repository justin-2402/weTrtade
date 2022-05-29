<?php
require_once 'view/baseView.php';

$view = new baseView();
$view->setSeitenName('profil');

$js = array('awdawdawd');
$view->setJsLinksHtmlFormat($js);
$css = array('awdawd');
$view->setCssLinksHtmlForm($css);

echo $view->getTopBaseView();
echo $view->getBottomBaseView();
