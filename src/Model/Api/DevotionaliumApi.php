<?php

namespace Devotionalium\Model\Api;

use Devotionalium\Devotionalium\Devotionalium;
use Devotionalium\Model\Storage\Transient;

class DevotionaliumApi
{
    const API_VERSION = Communicator::ENDPOINT_API_V2;

    /**
     * @var Communicator
     */
    private $communicator;

    /**
     * @var Transient
     */
    private $transient;

    /**
     * DevotionaliumApi constructor.
     */
    public function __construct()
    {
        $this->communicator = new Communicator(self::API_VERSION);
        $this->transient = new Transient();
    }

    /**
     * @param string $version
     * @param string $language
     * @param int $dayOffset
     * @return Devotionalium
     */
    public function loadDevotionalium(
        $version,
        $language,
        $dayOffset
    ) {
        $index = implode(
            '-',
            [Communicator::ACTION_DEVOTIONALIUM, $version, $language, $dayOffset, date('Y-m-d')]
        );
        if ($cached = $this->transient->load($index)) {
            return $cached;
        }

        $response = $this->communicator->get([
            Communicator::PARAM_VERSION => $version,
            Communicator::PARAM_LANGUAGE => $language,
            Communicator::PARAM_DAYOFFSET => $dayOffset
        ]);

        $verses = [];
        foreach ($response as $key => $item) {
            if (isset($item['text'])) {
                $verses[] = new Verse(
                    $item['biblePart'],
                    $item['book'],
                    $item['bookNumber'],
                    $item['chapter'],
                    $item['text'],
                    $item['textOriginal'],
                    $item['verses'],
                    $item['version']['name'],
                    $item['reference'],
                    $item['readingUrl']
                );
            }
        }
        $date = \DateTime::createFromFormat('Y-m-d', $response['date']);

        $devotionalium = new Devotionalium();
        $devotionalium->setVerses($verses);
        $devotionalium->setDate($date);

        $this->transient->save($index, $devotionalium);
        return $devotionalium;
    }

    /**
     * @param $language
     * @return Version[]
     */
    public function loadVersions($language = 'en')
    {
        $index = Communicator::ACTION_VERSIONS.'-'.$language;

        if ($cached = $this->transient->load($index)) {
            return $cached;
        }

        $response = $this->communicator->get(
            [Communicator::PARAM_LANGUAGE => $language],
            Communicator::ACTION_VERSIONS
        );
        $versions = [];
        foreach ($response['versions'] as $version) {
            $versions[] = new Version(
                $version['id'],
                $version['name']
            );
        }
        $this->transient->save($index, $versions);
        return $versions;
    }
}
