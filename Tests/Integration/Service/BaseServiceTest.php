<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Tests\Integration\Service;

use petrepatrasc\StarcraftConnectionLayerBundle\Service\GGTracker;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * No reason to mock the cURL wrapper library at this point, so I'm just going to test getters and setters
     * even though it's redundant.
     */
    public function testCurlWrapperDependency()
    {
        $ggTrackerApi = new GGTracker();
        $curlWrapper = new \Curl();

        $ggTrackerApi->setCurlWrapper($curlWrapper);
        $this->assertEquals($curlWrapper, $ggTrackerApi->getCurlWrapper());
    }
}