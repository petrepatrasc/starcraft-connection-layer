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
     * @param string $apiKey The application key used in order to call the service.
     */
    public function __construct($apiKey = null) {
        parent::__construct();

        if (!is_null($apiKey)) {
            $this->authorizationToken = $apiKey;
        } else {
            throw new StarcraftConnectionLayerException("No API key defined for the SC2 Ranks service.");
        }
    }

    /**
     * {@inheritdoc}
     * @param string $url
     * @return null|string
     */
    public function retrieveData($url)
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
            'api_key' => $this->getAuthorizationToken()
        ));

        $response = json_decode($this->curlWrapper->response, true);

        if (isset($response['error'])) {
            throw new StarcraftConnectionLayerException($response['error'], 500);
        }

        parent::retrieve($url);
    }
}