<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Tests\Integration\Service;

use petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException;
use petrepatrasc\StarcraftConnectionLayerBundle\Service\BlizzardApi;

class BlizzardApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlizzardApi
     */
    protected $blizzardApi;

    public function setUp()
    {
        parent::setUp();

        $this->blizzardApi = new BlizzardApi();
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     */
    public function testWebsiteThatDoesNotExist()
    {
        $this->blizzardApi->retrieveData('http://eu.battle.netTEST/api/sc2/profile/2048419/1/LionHeart/');
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     * @expectedExceptionCode 404
     * @expectedExceptionMessage Resource Not Found
     */
    public function testInvalidResource()
    {
        $this->blizzardApi->retrieveData('http://eu.battle.net/api/sc2/profile/2048419/1/LionHeart');
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid Application
     */
    public function testInvalidAuthenticationToken()
    {
        $this->blizzardApi->setAuthorizationToken("BNET c1fbf21b79c03191d:+3fE0RaKc+PqxN0gi8va5GQC35A====");
        $this->blizzardApi->retrieveData('http://eu.battle.net/api/sc2/profile/2048419/1/LionHeart/');
    }

    /**
     * @param $url
     * @dataProvider validDataProvider
     */
    public function testValidDataRetrieval($url)
    {
        $response = $this->blizzardApi->retrieveData($url);

        $this->assertNotNull($response);
        $this->assertGreaterThan(0, strlen($response));

        $jsonContentFound = false;
        foreach ($this->blizzardApi->getCurlWrapper()->response_headers as $key => $value) {
            if ($value == 'Content-Type: application/json;charset=UTF-8') {
                $jsonContentFound = true;
            }
        }
        $this->assertTrue($jsonContentFound);
    }

    public function validDataProvider() {
        return array(
            array('http://eu.battle.net/api/sc2/profile/2048419/1/LionHeart/'),
            array('http://eu.battle.net/api/sc2/profile/2048419/1/LionHeart/ladders'),
            array('http://eu.battle.net/api/sc2/profile/2048419/1/LionHeart/matches'),
            array('http://eu.battle.net/api/sc2/ladder/2000'),
            array('http://eu.battle.net/api/sc2/ladder/grandmaster'),
            array('http://eu.battle.net/api/sc2/ladder/grandmaster/last'),
            array('http://eu.battle.net/api/sc2/data/rewards'),
            array('http://eu.battle.net/api/sc2/data/achievements'),
        );
    }
}