<?php
require_once 'get-set/registrierenGetSet.php';

class registrierenModell extends registrierenGetSet
{

    private function checkVornameInput()
    {
        if(empty($this->getVorname()))
        {
            return array(FALSE, 'bitte vorname eingeben');
        }
        elseif(preg_match('/[^a-zA-Z]/', $this->getVorname()))
        {
            return array(FALSE, 'der Vorname darf nur buchstaben enthalten');
        }
        else
        {
            return array(TRUE);
        }
    }

    private function checkNachnameInput()
    {
        if(empty($this->getNachname()))
        {
            return array(FALSE, 'bitte nachname eingeben');
        }
        elseif(preg_match('/[^a-zA-Z]/', $this->getNachname()))
        {
            return array(FALSE, 'der Nachname dar fnur buchstaben enthalten');
        }
        else
        {
            return array(TRUE);
        }
    }

    private function checkEmailInput()
    {
        $con = $this->emailCheckCon();
        $sql = 'SELECT email FROM accounts WHERE email=?';
        $prepare = $con->prepare($sql);
        $prepare->execute(array($this->getEmail()));
        $result = $prepare->fetch();

        if($result)
        {
            return array(FALSE, 'email ist schon vergeben');
        }
        elseif (empty($this->getEmail()))
        {
            return array(FALSE, 'bitte email eingeben');
        }
        elseif(preg_match("/[^ßa-zA-Z0-9.@-_]/", $this->getEmail()))
        {
            return array(FALSE, 'email ungültig');
        }
        else
        {
            return array(TRUE);
        }
    }

    public function checkPasswortInput()
    {
        if(empty($this->getPasswort()) or empty($this->getPasswortW()))
        {
            return array(FALSE, 'passwörter müssen ausgefüllt sein');
        }
        elseif (!preg_match("/[a-z]/", $this->getPasswort()) or !preg_match("/[A-Z]/", $this->getPasswort()) or !preg_match("/[0-9]/", $this->getPasswort()))
        {
            return array(FALSE, 'das passwort muss mindestens klein/großbuchstaben und zahlen enthalten');
        }
        elseif (strlen($this->getPasswort()) < 10)
        {
            return array(FALSE, 'das passwort muss mindestens 10 zeichen haben');
        }
        elseif ($this->getPasswort() !== $this->getPasswortW())
        {
            return array(FALSE, 'die passwörter müssen übereinstimmen');
        }
        else
        {
            return array(TRUE);
        }
    }
    
    private function altGenugCheck()
    {
        $userAlterArray = explode('-', $this->getGeburtstag());
        $mindestalterArray = explode('-',date("Y-n-j", time()));

        $mindestalter = 18;

        $userAlterAssoArray = ['jahr'=>(int)$userAlterArray[0], 'monat'=>(int)$userAlterArray[1], 'tag'=>(int)$userAlterArray[2]];
        $mindestalterAssoArray = ['jahr'=>(int)$mindestalterArray[0] - $mindestalter, 'monat'=>(int)$mindestalterArray[1], 'tag'=>(int)$mindestalterArray[2]];

        if($userAlterAssoArray['jahr'] < $mindestalterAssoArray['jahr'])
        {
            return TRUE;
        }
        elseif ($userAlterAssoArray['jahr'] <= $mindestalterAssoArray['jahr'] and
                $userAlterAssoArray['monat'] < $mindestalterAssoArray['monat'])
        {
            return TRUE;
        }
        elseif ($userAlterAssoArray['jahr'] <= $mindestalterAssoArray['jahr'] and
                $userAlterAssoArray['monat'] <= $mindestalterAssoArray['monat'] and
                $userAlterAssoArray['tag'] <= $mindestalterAssoArray['tag'])
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    private function checkAlterInput()
    {
        if(empty($this->getGeburtstag()))
        {
            return array(FALSE, 'bitte alter eingeben');
        }
        elseif(!$this->altGenugCheck())
        {
            return array(FALSE, 'du musst mindestens 18 sein');
        }
        else
        {
            return array(TRUE);
        }
    }

    public function checkformInput()
    {
        $vornameCheckResult = $this->checkVornameInput();
        $nachnameCheckResult = $this->checkNachnameInput();
        $emailCheckResult = $this->checkEmailInput();
        $alterCheckResult = $this->checkAlterInput();
        $passwortCheckResult = $this->checkPasswortInput();

        if($vornameCheckResult[0] and $nachnameCheckResult[0] and $emailCheckResult[0] and $alterCheckResult[0] and $passwortCheckResult[0])
        {
            return array(TRUE);
        }
        else
        {
            $errorMessage = $vornameCheckResult[0] ? '' : $vornameCheckResult[1]."<br>";
            $errorMessage .= $nachnameCheckResult[0] ? '' : $vornameCheckResult[1]."<br>";
            $errorMessage .= $emailCheckResult[0] ? '': $emailCheckResult[1]."<br>";
            $errorMessage .= $alterCheckResult[0] ? '': $alterCheckResult[1]."<br>";
            $errorMessage .= $passwortCheckResult[0] ? '' : $passwortCheckResult[1]."<br>";

            /**
             * email error wird zurückgegeben damit falls die email vergeben ist man den error anzeigen kann
             * weil wird noch nicht mit js gemacht
             */
            if(!$emailCheckResult[0])
            {
                return array(FALSE, $errorMessage, $emailCheckResult[1]);
            }
            else
            {
                return array(FALSE, $errorMessage);
            }


        }
    }

    public function registrateUser()
    {
        $con = $this->registrateUserCon();
        $erstelldatum = date('Y-m-d H-i-s',time());

        $sql = 'INSERT INTO accounts(vorname, nachname, email, passwort, geburtstag, erstelldatum) VALUES (?,?,?,?,?,?)';
        $prepare = $con->prepare($sql);
        $prepare->execute(array($this->getVorname(), $this->getNachname(), $this->getEmail(), $this->getPasswort(), $this->getGeburtstag(), $erstelldatum));
    }
    public function hashPasswort()
    {
        $this->setPasswort(password_hash($this->getPasswort(), PASSWORD_DEFAULT));
    }
}