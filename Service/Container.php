<?php

class Container
{
    private $configuration;

    private $pdo;

    private $cityLoader;

    private $messageService;

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
     * @return MessageService
     */
    public function getMessageService()
    {
        if ($this->messageService === null) {
            $this->messageService = new messageService();
        }

        return $this->messageService;
    }
}
