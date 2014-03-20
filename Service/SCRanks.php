<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;

use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

/**
 * Handles integration with the SC2 Ranks service.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
class SCRanks extends BaseService implements ServiceInterface
{
    /**
     * Application key used in order to call the service.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * @param string $apiKey The application key used in order to call the service.
     */
    public function __construct($apiKey) {
        parent::__construct();

        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveData($url, $authorizationToken = null)
    {
        $this->retrieve($url);

        return $this->curlWrapper->response;
    }

    /**
     * {@inheritdoc}
     */
    protected function retrieve($url)
    {
        $this->curlWrapper->get($url, array(
            'api_key' => $this->apiKey
        ));

        $response = json_decode($this->curlWrapper->response, true);

        if (isset($response['error'])) {
            throw new StarcraftConnectionLayerException($response['error'], 500);
        }

        parent::retrieve($url);
    }

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


}