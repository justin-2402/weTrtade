<?php
require_once 'view/baseView.php';
require_once 'view/registrierenView.php';
require_once 'modell/registrierenModell.php';
require_once 'modell/safeForm.php';


$baseView = new baseView();
$registrierenView = new registrierenView();
$registrierenModell = new registrierenModell();
$safeForm = new safeForm();

$baseView->setSeitenName('registrieren');
$js = array('public/js/form.js');
$baseView->setJsLinksHtmlFormat($js);

echo $baseView->getTopBaseView();
echo $registrierenView->getRegistrierenView();
echo $baseView->getBottomBaseView();

if(isset($_POST['registrieren']))
{
    $vorname = $safeForm->convertInput($_POST['vorname']);
    $nachname = $safeForm->convertInput($_POST['nachname']);
    $email = $safeForm->convertInput($_POST['email']);
    $geburtstag = $safeForm->convertInput($_POST['geburtstag']);
    $passwort = $safeForm->convertInput($_POST['passwort']);
    $passwortW = $safeForm->convertInput($_POST['passwortW']);

    $registrierenModell->setVorname($vorname);
    $registrierenModell->setNachname($nachname);
    $registrierenModell->setEmail($email);
    $registrierenModell->setGeburtstag($geburtstag);
    $registrierenModell->setPasswort($passwort);
    $registrierenModell->setPasswortW($passwortW);

    $formCheck = $registrierenModell->checkformInput();
    if($formCheck[0])
    {
        $registrierenModell->hashPasswort();
        $registrierenModell->registrateUser();
        echo 'erlogreich registriert!';
    }
    else
    {
        echo "<noscript>".$formCheck[1]."</noscript>";
        echo $formCheck[2] ?? '';
    }



}

