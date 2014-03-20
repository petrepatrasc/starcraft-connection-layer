<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Tests\Unit\Service;


use petrepatrasc\StarcraftConnectionLayerBundle\Service\BlizzardApi;
use petrepatrasc\StarcraftConnectionLayerBundle\Service\GGTracker;
use petrepatrasc\StarcraftConnectionLayerBundle\Service\OverviewService;
use petrepatrasc\StarcraftConnectionLayerBundle\Service\SCRanks;

class OverviewServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * No use in mocking the objects at the moment, so just testing the getters and setters for code coverage.
     * While generally speaking, doing this does not bring any value, I prefer this approach than removing the file
     * from code coverage altogether, as it may bring up problems in the future, if we decide to extend it beyond
     * what it is currently there.
     */
    public function testServicesDependency() {
        $blizzardApiService = new BlizzardApi();
        $ggTrackerService = new GGTracker();
        $scRanksService = new SCRanks();

        $overviewService = new OverviewService();
        $overviewService->setBlizzardApi($blizzardApiService)
            ->setGgTracker($ggTrackerService)
            ->setScRanks($scRanksService);

        $this->assertEquals($blizzardApiService, $overviewService->getBlizzardApi());
        $this->assertEquals($ggTrackerService, $overviewService->getGgTracker());
        $this->assertEquals($scRanksService, $overviewService->getScRanks());
    }
}