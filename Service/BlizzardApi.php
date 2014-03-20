<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;

class BlizzardApi extends BaseService implements ServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function retrieveData($url, $authorizationToken = null)
    {
        if (!is_null($authorizationToken)) {
            $this->curlWrapper->setHeader('Authorization', $authorizationToken);
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