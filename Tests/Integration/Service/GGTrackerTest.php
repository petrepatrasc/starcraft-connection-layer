<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Tests\Integration\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Service\GGTracker;

class GGTrackerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GGTracker
     */
    protected $ggTrackerApi;

    public function setUp() {
        parent::setUp();

        $this->ggTrackerApi = new GGTracker();
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     * @expectedExceptionMessage Not Found
     * @expectedExceptionCode 404
     */
    public function testInvalidUrl() {
        $this->ggTrackerApi->retrieveData('http://api.ggtracker.com/api/v1/identitiess/1455.json');
    }

    /**
     * @expectedException \petrepatrasc\StarcraftConnectionLayerBundle\Exception\StarcraftConnectionLayerException
     * @expectedExceptionMessage Couldn't resolve host 'api.ggtracker.comTEST'
     */
    public function testWebsiteThatDoesNotExist()
    {
        $this->ggTrackerApi->retrieveData('http://api.ggtracker.comTEST/api/v1/identitiess/1455.json');
    }

    /**
     * @param $url
     * @dataProvider validDataProvider
     */
    public function testValidData($url) {
        $response = $this->ggTrackerApi->retrieveData($url);

        $this->assertNotNull($response);
        $this->assertGreaterThan(0, strlen($response));
    }

    public function validDataProvider() {
        return array(
            array('http://api.ggtracker.com/api/v1/identities/1455.json'),
            array('http://api.ggtracker.com/api/v1/matches/3529593.json'),
            array('https://gg2-matchblobs-prod.s3.amazonaws.com/3529593'),
            array('http://api.ggtracker.com/api/v1/matches?category=Ladder&game_type=1v1&identity_id=1455&page=1&paginate=true&race=protoss&vs_race=terran'),
            array('http://api.ggtracker.com/api/v1/matches?identity_id=1455&paginate=true&stats=apm(avg:[<1455])'),
            array('http://api.ggtracker.com/api/v1/matches?category=Ladder&game_type=1v1&identity_id=1455&paginate=true&stats=spending_skill(avg:[<1455])'),
        );
    }
}