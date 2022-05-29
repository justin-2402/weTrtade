<?php
require_once 'modell/dbConnect.php';

class registrierenGetSet extends dbConnect
{
    private $vorname = '';
    private $nachname = '';
    private $email = '';
    private $geburtstag = '';
    private $passwort = '';
    private $passwortW = '';

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $geburtstag
     */
    public function setGeburtstag(string $geburtstag): void
    {
        $this->geburtstag = $geburtstag;
    }

    /**
     * @return string
     */
    public function getGeburtstag(): string
    {
        return $this->geburtstag;
    }

    /**
     * @param string $nachname
     */
    public function setNachname(string $nachname): void
    {
        $this->nachname = $nachname;
    }

    /**
     * @return string
     */
    public function getNachname(): string
    {
        return $this->nachname;
    }

    /**
     * @param string $passwort
     */
    public function setPasswort(string $passwort): void
    {
        $this->passwort = $passwort;
    }

    /**
     * @return string
     */
    public function getPasswort(): string
    {
        return $this->passwort;
    }

    /**
     * @param string $passwortW
     */
    public function setPasswortW(string $passwortW): void
    {
        $this->passwortW = $passwortW;
    }

    /**
     * @return string
     */
    public function getPasswortW(): string
    {
        return $this->passwortW;
    }

    /**
     * @param string $vorname
     */
    public function setVorname(string $vorname): void
    {
        $this->vorname = $vorname;
    }

    /**
     * @return string
     */
    public function getVorname(): string
    {
        return $this->vorname;
    }

}