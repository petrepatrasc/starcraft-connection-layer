<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;

/**
 * Defines methods that should be implemented by all of the child classes.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
interface ServiceInterface {

    /**
     * Retrieve data from this particular API service.
     *
     * @param string $url The URL that should be called in order to retrieve the data.
     * @return string
     */
    public function retrieveData($url);
}