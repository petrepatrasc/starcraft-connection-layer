<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

abstract class BaseService
{
    /**
     * @var \Curl
     */
    protected $curlWrapper;

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
}