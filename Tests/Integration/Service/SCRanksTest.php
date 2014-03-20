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

        $applicationKeyStoredInEnvironmentalVariable = getenv("SYMFONY__SC2RANKS_API_KEY");
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

    public function validDataProvider() {
        return array(
            array('http://api.sc2ranks.com/v2/data')
        );
    }
}