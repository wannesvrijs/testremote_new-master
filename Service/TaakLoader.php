<?php
class TaakLoader
{
    private $pdo;
    private $week;
    private $year;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Taak[]
     */
    public function getTaken()
    {
        $taken = array();

        $takenData = $this->queryForTaken();

        foreach ($takenData as $taakData) {
            $taken[] = $this->createTaakFromData($taakData);
        }

        return $taken;
    }


    private function setRequestedTaakWeek()
    {
        $this->year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
        $this->week = (isset($_GET['week'])) ? $_GET['week'] : date("W");

        if ($this->week > 52)
        {
            $this->year++;
            $this->week = 1;
        }
        elseif ($this->week < 1)
        {
            $this->year--;
            $this->week = 52;
        }
    }

    public function getSetYear()
    {
       $this->setRequestedTaakWeek();
       return $this->year;
    }
    public function getSetWeek()
    {
        $this->setRequestedTaakWeek();
        if( isset($_GET['week']) AND $this->week < 10 ) { $this->week = '0' . $this->week; }
        return $this->week;
    }

    /**
     * @param $id
     * @return Taak[]
     */
    public function findTakenByDate($datum)
    {
        $taken = array();

        $statement = $this->getPDO()->prepare('SELECT * FROM taak WHERE taa_datum = :datum');
        $statement->execute(array('datum' => $datum));
        $taakArray = $statement->fetch(PDO::FETCH_ASSOC);


        if (!$taakArray) {
            return null;
        }

        $taken[] = $this->createTaakFromData($taakArray);

        return $taken;
    }

    private function createTaakFromData(array $taakData)
    {

        $taak = new Taak();

        $taak->setId( $taakData['taa_id'] );
        $taak->setOmschrijving( $taakData['taa_omschr'] );
        $taak->setDatum( $taakData['taa_datum'] );

        return $taak;
    }

    /**
     * @return PDO
     */
    private function getPDO()
    {
        return $this->pdo;
    }

    private function queryForTaken()
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM taak');
        $statement->execute();
        $takenArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $takenArray;
    }

}