<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;
use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

/**
 * Handles connectivity to the GGTracker service.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
class GGTracker extends BaseService implements ServiceInterface
{

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
        $this->curlWrapper->get($url);

        $response = $this->curlWrapper->response;

        if ($response == "Not Found") {
            throw new StarcraftConnectionLayerException("Not Found", 404);
        }

        parent::retrieve($url);
    }
}