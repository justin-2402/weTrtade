<?php
ini_set('max_execution_time', 600);
require_once 'modell/dbConnect.php';

class getMarktdaten extends dbConnect
{
    private $con = NULL;
    private $aktienIds = array();
    private $aktienDaten = array();

    public function __construct()
    {
        $this->con = $this->marktdatenCon();
        $this->getAktienIds();
    }

    /**
     * returnt den preis, tages start, tagestief und hoch
     */

    private function getAktienIds()
    {
        $sql = 'SELECT id FROM aktien';
        $prepare = $this->con->prepare($sql);
        $prepare->execute();
        while ($ids = $prepare->fetch())
        {
            $this->aktienIds[] = (int)$ids['id'];
        }

    }

    private function executeFetchQuery($sql, array $executeParameter = NULL)
    {

        $prepare = $this->con->prepare($sql);
        $executeParameter !== NULL ? $prepare->execute($executeParameter) : $prepare->execute();
        return $prepare->fetchAll();

    }

    private function setDatenWithId($aktienId)
    {

        $aktuellesDatum = date('Y-m-d', time());

        if(!isset($_POST['optional']))
        {
            $tagesStartSql = 'SELECT Preis FROM aktienpreise WHERE id = (SELECT min(id) FROM aktienpreise WHERE aktienId = ? AND date(datum) = ?)';
            $tagesStartPara = array($aktienId, $aktuellesDatum);
            $tagesStartPreis = (float)$this->executeFetchQuery($tagesStartSql, $tagesStartPara)[0]['Preis'];
            $this->aktienDaten[$aktienId]['tagesStart'] = $tagesStartPreis;

            $nameSql = 'SELECT name FROM aktien WHERE id = ?';
            $namePara = array($aktienId);
            $this->aktienDaten[$aktienId]['name'] = $this->executeFetchQuery($nameSql, $namePara)[0]['name'];

        }

        $preisSql = 'SELECT Preis FROM aktienpreise WHERE id = (SELECT max(id) FROM aktienpreise WHERE aktienId = ?)';
        $preisExePara = array($aktienId);
        $this->aktienDaten[$aktienId]['preis'] = (float)$this->executeFetchQuery($preisSql, $preisExePara)[0]['Preis'];


        $this->aktienDaten[$aktienId]['id'] = $aktienId;
    }

    private function getMarktÜbersicht()
    {

        foreach ($this->aktienIds as $id)
        {
            $this->setDatenWithId($id);
        }

        header('content-Type: application/json');
        echo json_encode($this->aktienDaten);
    }

    public function run()
    {
        if(isset($_POST['ajaxMarktdaten']))
        {
            if($_POST['ajaxMarktdaten'] === 'getUebersicht')
            {
                return $this->getMarktÜbersicht();
            }
        }
    }
}
$marktdaten = new getMarktdaten();
$marktdaten->run();
