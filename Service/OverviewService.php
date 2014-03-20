<?php

namespace petrepatrasc\StarcraftConnectionLayerBundle\Service;

/**
 * Handles exposure of all of the supported services.
 * @package petrepatrasc\StarcraftConnectionLayerBundle\Service
 */
class OverviewService
{

    /**
     * Holds the Blizzard API interaction service.
     *
     * @var BlizzardApi
     */
    protected $blizzardApi;

    /**
     * Holds the GG Tracker integration service.
     *
     * @var GGTracker
     */
    protected $ggTracker;

    /**
     * Holds the SC2 Ranks integration service.
     *
     * @var SCRanks
     */
    protected $scRanks;

    public function __construct()
    {
        $this->blizzardApi = new BlizzardApi();
        $this->ggTracker = new GGTracker();
        $this->scRanks = new SCRanks();
    }

    /**
     * @param \petrepatrasc\StarcraftConnectionLayerBundle\Service\BlizzardApi $blizzardApi
     * @return $this
     */
    public function setBlizzardApi($blizzardApi)
    {
        $this->blizzardApi = $blizzardApi;
        return $this;
    }

    /**
     * @return \petrepatrasc\StarcraftConnectionLayerBundle\Service\BlizzardApi
     */
    public function getBlizzardApi()
    {
        return $this->blizzardApi;
    }

    /**
     * @param \petrepatrasc\StarcraftConnectionLayerBundle\Service\GGTracker $ggTracker
     * @return $this
     */
    public function setGgTracker($ggTracker)
    {
        $this->ggTracker = $ggTracker;
        return $this;
    }

    /**
     * @return \petrepatrasc\StarcraftConnectionLayerBundle\Service\GGTracker
     */
    public function getGgTracker()
    {
        return $this->ggTracker;
    }

    /**
     * @param \petrepatrasc\StarcraftConnectionLayerBundle\Service\SCRanks $scRanks
     * @return $this
     */
    public function setScRanks($scRanks)
    {
        $this->scRanks = $scRanks;
        return $this;
    }

    /**
     * @return \petrepatrasc\StarcraftConnectionLayerBundle\Service\SCRanks
     */
    public function getScRanks()
    {
        return $this->scRanks;
    }


}