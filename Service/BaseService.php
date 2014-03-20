<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

/**
 * Keeps the curl wrapper used in order to expose the services and offers some functionality that should be implemented
 * by all of the individual service implementations.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
abstract class BaseService
{
    /**
     * @var \Curl
     */
    protected $curlWrapper;

    /**
     * Authorization token used in order to call the service.
     *
     * @var string
     */
    protected $authorizationToken;

    public function __construct()
    {
        $this->curlWrapper = new \Curl();
    }

    /**
     * Method that allows for easy retrieval of data from a URL, and triggers a certain type of exception when something goes wrong.
     *
     * @param string $url The URL that should be accessed.
     * @throws \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     */
    protected function retrieve($url)
    {
        if ($this->curlWrapper->error) {
            throw new StarcraftConnectionLayerException($this->curlWrapper->error_message, $this->curlWrapper->error_code);
        }
    }

    /**
     * @param \Curl $curlWrapper
     * @return $this
     */
    public function setCurlWrapper($curlWrapper)
    {
        $this->curlWrapper = $curlWrapper;
        return $this;
    }

    /**
     * @return \Curl
     */
    public function getCurlWrapper()
    {
        return $this->curlWrapper;
    }

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setAuthorizationToken($apiKey)
    {
        $this->authorizationToken = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationToken()
    {
        return $this->authorizationToken;
    }
}