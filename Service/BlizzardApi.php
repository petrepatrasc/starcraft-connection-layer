<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

/**
 * Offers integration with the Blizzard API.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
class BlizzardApi extends BaseService implements ServiceInterface
{
    /**
     * {@inheritdoc}
     * @param string $url
     * @return null|string
     */
    public function retrieveData($url)
    {
        if (!is_null($this->getAuthorizationToken())) {
            $this->curlWrapper->setHeader('Authorization', $this->getAuthorizationToken());
        }

        $this->retrieve($url);

        return $this->curlWrapper->response;
    }

    /**
     * {@inheritdoc}
     */
    protected function retrieve($url) {
        $this->curlWrapper->get($url);

        $response = json_decode($this->curlWrapper->response, true);

        if (isset($response['status']) && $response['status'] == 'nok') {
            throw new StarcraftConnectionLayerException($response['message'], $response['code']);
        }

        parent::retrieve($url);
    }
}