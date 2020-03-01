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

    private $uploadService;

    private $saveService;

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
     * @return UploadService
     */
    public function getUploadService()
    {
        if ($this->uploadService === null) {
            $this->uploadService = new UploadService();
        }

        return $this->uploadService;
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


}
