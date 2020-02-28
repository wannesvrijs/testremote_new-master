<?php
class CityLoader
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return City[]
     */
    public function getCities()
    {
        $cities = array();

        $citiesData = $this->queryForCities();

        foreach ($citiesData as $cityData) {
            $cities[] = $this->createCityFromData($cityData);
        }

        return $cities;
    }

    /**
     * @param $id
     * @return City[]
     */
    public function findOneById($id)
    {
        // city wordt een array van 1 item zodat replacecities algemeen gebruikt kan worden
        $city = array();

        $statement = $this->getPDO()->prepare('SELECT * FROM images WHERE img_id = :id');
        $statement->execute(array('id' => $id));
        $cityArray = $statement->fetch(PDO::FETCH_ASSOC);


        if (!$cityArray) {
            return null;
        }

        $city[] = $this->createCityFromData($cityArray);

        return $city;
    }

    private function createCityFromData(array $cityData)
    {

        $city = new City();

        $city->setId( $cityData['img_id'] );
        $city->setFileName( $cityData['img_filename'] );
        $city->setTitle( $cityData['img_title'] );
        $city->setWidth( $cityData['img_width'] );
        $city->setHeight( $cityData['img_height'] );

        return $city;
    }

    /**
     * @return PDO
     */
    private function getPDO()
    {
        return $this->pdo;
    }

    private function queryForCities()
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM images');
        $statement->execute();
        $citiesArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $citiesArray;
    }

}