<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Tests\Integration\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Service\SCRanks;

class SCRanksTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SCRanks
     */
    protected $scRanksApi;

    public function setUp() {
        parent::setUp();

        $applicationKeyStoredInEnvironmentalVariable = getenv("SYMFONY__SC2RANKS__API__KEY");
        $this->scRanksApi = new SCRanks($applicationKeyStoredInEnvironmentalVariable);
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValidData($url) {
        $response = $this->scRanksApi->retrieveData($url);

        $this->assertNotNull($response);
        $this->assertGreaterThan(0, strlen($response));

        $jsonContentFound = false;
        foreach ($this->scRanksApi->getCurlWrapper()->response_headers as $key => $value) {
            if ($value == 'Content-Type: application/json; charset=utf-8') {
                $jsonContentFound = true;
            }
        }
        $this->assertTrue($jsonContentFound);
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     */
    public function testNullApplicationKey() {
        $this->scRanksApi = new SCRanks();

        $response = $this->scRanksApi->retrieveData('http://api.sc2ranks.com/v2/data');
        $this->assertNull($response);
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     */
    public function testInvalidApplicationKey() {
        $this->scRanksApi = new SCRanks("TEST");

        $response = $this->scRanksApi->retrieveData('http://api.sc2ranks.com/v2/data');
        $this->assertNull($response);
    }

    public function validDataProvider() {
        return array(
            array('http://api.sc2ranks.com/v2/data')
        );
    }
}