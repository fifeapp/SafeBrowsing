<?php

namespace SafeBrowsing;

/**
 * Class Client
 * @package SafeBrowsing
 */
class Client
{
    /**
     * @var
     */
    private $clientName;
    /**
     * @var
     */
    private $clientVersion;
    /**
     * @var
     */
    private $apiKey;

    /**
     * @param $clientName
     * @param $clientVersion
     * @param $apiKey
     */
    public function __construct($clientName, $clientVersion, $apiKey)
    {
        $this->clientName = $clientName;
        $this->clientVersion = $clientVersion;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @return string
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}
