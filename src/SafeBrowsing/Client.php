<?php

namespace SafeBrowsing;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Client
 * @package SafeBrowsing
 */
class Client
{
    /**
     * Safe browsing API version.
     */
    const P_VER = '3.1';

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
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Lookup up a URL in Google's Safe Browsing API.
     *
     * @param $url
     * @return bool
     * @throws InvalidLookup
     * @throws MalwareDetected
     */
    public function lookup($url)
    {
        $query = [
            'client' => $this->getClientName(),
            'appver' => $this->getClientVersion(),
            'key' => $this->getApiKey(),
            'pver' => self::P_VER,
            'url' => urlencode(utf8_encode($url)),
        ];

        try {
            $response = $this->client->get('https://sb-ssl.google.com/safebrowsing/api/lookup', ['query' => $query]);
        } catch(RequestException $e) {
            throw new InvalidLookup('Please verify your credentials.');
        }

        if ($response->getStatusCode() === 200) {
            throw new MalwareDetected;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param mixed $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * @param mixed $clientVersion
     */
    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = $clientVersion;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
