<?php
class TaakLoader
{
    private $pdo;

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

    /**
     * @param $id
     * @return Taak[]
     */
    public function findOneById($id)
    {
        // taak wordt een array van 1 item zodat replacetaken algemeen gebruikt kan worden
        $taak = array();

        $statement = $this->getPDO()->prepare('SELECT * FROM taak WHERE taa_id = :id');
        $statement->execute(array('id' => $id));
        $taakArray = $statement->fetch(PDO::FETCH_ASSOC);


        if (!$taakArray) {
            return null;
        }

        $taak[] = $this->createTaakFromData($taakArray);

        return $taak;
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