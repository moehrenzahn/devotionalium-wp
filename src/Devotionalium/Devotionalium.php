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
     */
    public function getVerses(): array
    {
        if (!isset($this->verses)) {
            $this->load();
        }
        return $this->verses;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
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
     */
    private function load()
    {
        if (!isset($this->config) || !isset($this->api)) {
            throw new \Exception('Instance is not equipped for lazy-loading');
        }
        $devotionalium = $this->api->loadDevotionalium(
            $this->config->getVersion(),
            $this->config->getLanguage(),
            $this->config->getDayOffset()
        );
        $this->setDate($devotionalium->getDate());
        $this->setVerses($devotionalium->getVerses());
    }
}
