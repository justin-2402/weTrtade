<?php

class dbConnect
{
    private $localhost = '127.0.0.1';
    private $liveServer = '5.249.161.69';
    private string $dsn = "mysql:host=127.0.0.1;dbname=wetrade";

    public function emailCheckCon()
    {
        try
        {
            return new PDO($this->dsn, 'emailCheckUser', '');
        }
        catch (Exception $e)
        {
            echo $e;
        }
    }

    public function registrateUserCon()
    {
        try
        {
            return new PDO($this->dsn, 'registrateUserCon', '');
        }
        catch (Exception $exception)
        {
            echo $exception;
        }
    }
}