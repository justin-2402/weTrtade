<?php
require_once 'modell/dbConnect.php';

if(isset($_GET['emailCheck']))
{
    $email = $_GET['emailCheck'];

    $dbConnect = new dbConnect();

    $con = $dbConnect->emailCheckCon();
    $sql = 'SELECT email FROM accounts WHERE email=?';
    $prepare = $con->prepare($sql);
    $prepare->execute(array($email));
    $result = $prepare->fetch();
    //wenn email vorhanden 1 wenn nicht 0
    $check = $result? 1 : 0;


    header('content-type: text');
    echo $check;
}
