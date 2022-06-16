<?php

class dbConnect
{
    public function marktdatenCon()
    {
        /**
         *braucht select priv auf aktienpreise und aktien
         *
         */

        $marktdatenConDaten = file('modell/connectDataFiles/marktdatenCon.txt');

        $username = trim($marktdatenConDaten[0]);
        $pw = trim($marktdatenConDaten[1]);
        $dsn = trim($marktdatenConDaten[2]);

        try
        {
            return new PDO($dsn, $username, $pw);
        }
        catch (Exception $exception)
        {
            echo $exception;
        }

    }

    public function emailCheckCon()
    {
        /**
         * braucht select priv
         */

        $emailConDaten = file("modell/connectDataFiles/emailCheckCon.txt");

        $username = trim($emailConDaten[0]);
        $pw = trim($emailConDaten[1]);
        $dsn = trim($emailConDaten[2]);

        try
        {
            return new PDO($dsn, $username, $pw);
        }
        catch (Exception $e)
        {
            echo $e;
        }
    }

    public function registrateUserCon()
    {
        /**
         * braucht insert priv
         */

        $registrateConData = file('modell/connectDataFiles/registrateUserCon.txt');

        $username = trim($registrateConData[0]);
        $pw = trim($registrateConData[1]);
        $dsn = trim($registrateConData[2]);

        try
        {
            return new PDO($dsn, $username, $pw);
        }
        catch (Exception $exception)
        {
            echo $exception;
        }
    }
}