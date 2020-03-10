<?php

class Container
{
    private $configuration;

    private $pdo;

    private $cityLoader;

    private $taakLoader;

    private $messageService;

    private $userService;

    private $opmaakService;

    private $uploadEid;

    private $uploadImage;

    private $saveService;

    private $detailEiffeltoren;

    private $detailBigBen;

    private $detailTvToren;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['dbdsn'],
                $this->configuration['dbuser'],
                $this->configuration['dbpasswd']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return CityLoader
     */
    public function getCityLoader()
    {
        if ($this->cityLoader === null) {
            $this->cityLoader = new CityLoader($this->getPDO());
        }

        return $this->cityLoader;
    }

    /**
     * @return TaakLoader
     */
    public function getTaakLoader()
    {
        if ($this->taakLoader === null) {
            $this->taakLoader = new TaakLoader($this->getPDO());
        }

        return $this->taakLoader;
    }
    
    /**
     * @return MessageService
     */
    public function getMessageService()
    {
        if ($this->messageService === null) {
            $this->messageService = new messageService();
        }

        return $this->messageService;
    }

    /**
     * @return UserService
     */
    public function getUserService (){

        if ($this->userService == null){
            $this->userService = new UserService();
        }

        return $this->userService;

    }

    /**
     * @return OpmaakService
     */
    public function getOpmaakService()
    {
        if ($this->opmaakService === null) {
            $this->opmaakService = new OpmaakService();
        }

        return $this->opmaakService;
    }

    /**
     * @return UploadEid
     */
    public function getUploadEid()
    {
        if ($this->uploadEid === null) {
            $this->uploadEid = new UploadEid();
        }

        return $this->uploadEid;
    }


    /**
     * @return UploadImage
     */
    public function getUploadImage()
    {
        if ($this->uploadImage === null) {
            $this->uploadImage = new UploadImage();
        }

        return $this->uploadImage;
    }


    /**
     * @return SaveService
     */
    public function getSaveService()
    {
        if ($this->saveService === null) {
            $this->saveService = new SaveService();
        }

        return $this->saveService;
    }

    /**
     * @return DetailEiffeltoren
     */
    public function getDetailEiffeltoren()
    {
        if ($this->detailEiffeltoren === null) {
            $this->detailEiffeltoren = new DetailEiffeltoren();
        }

        return $this->detailEiffeltoren;
    }

    /**
     * @return DetailBigBen
     */
    public function getDetailBigBen()
    {
        if ($this->detailBigBen === null) {
            $this->detailBigBen = new DetailBigBen();
        }

        return $this->detailBigBen;
    }

    /**
     * @return DetailTvToren
     */
    public function getDetailTvToren()
    {
        if ($this->detailTvToren === null) {
            $this->detailTvToren = new DetailTvToren();
        }

        return $this->detailTvToren;
    }




}
