<?php

namespace Devotionalium\Devotionalium;

use Devotionalium\ConfigAccessor;
use Devotionalium\Model\Api\DevotionaliumApi;
use Devotionalium\Model\Api\Verse;

class Devotionalium
{
    /**
     * @var DevotionaliumApi
     */
    private $api;

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * @var Verse[]
     */
    private $verses;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * Devotionalium constructor.
     *
     * @param DevotionaliumApi|null $api
     * @param ConfigAccessor|null $config
     */
    public function __construct(
        DevotionaliumApi $api = null,
        ConfigAccessor $config = null
    ) {
        $this->api = $api;
        $this->config = $config;
    }

    /**
     * @return Verse[]
     * @throws \Exception
     */
    public function getVerses()
    {
        if (!isset($this->verses)) {
            $this->load();
        }
        return $this->verses;
    }

    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function getDate()
    {
        if (!isset($this->date)) {
            $this->load();
        }
        return $this->date;
    }

    /**
     * @param Verse[] $verses
     */
    public function setVerses(array $verses)
    {
        $this->verses = $verses;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Lazily load content from api.
     *
     * @throws \Exception
     */
    private function load()
    {
        if (!isset($this->config) || !isset($this->api)) {
            throw new \Exception('Instance is not equipped for lazy-loading');
        }
        $offset = $this->config->getDayOffset();
        $date = date('Y-m-d', time() + (int)$offset * 86400);
        $devotionalium = $this->api->loadDevotionalium(
            $this->config->getVersion(),
            $this->config->getLanguage(),
            $date,
            $this->config->isShowQuran()
        );
        $this->setDate($devotionalium->getDate());
        $this->setVerses($devotionalium->getVerses());
    }
}
