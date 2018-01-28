<?php

namespace Devotionalium\Model\Api;

use Devotionalium\Devotionalium\Devotionalium;

class DevotionaliumApi
{
    const API_VERSION = Communicator::ENDPOINT_API_V2;

    /**
     * @var Communicator
     */
    private $communicator;

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
        $this->communicator = new Communicator(self::API_VERSION);
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
                    $item['reference']
                );
            }
        }
        $date = \DateTime::createFromFormat('Y-m-d', $response['date']);

        $devotionalium = new Devotionalium();
        $devotionalium->setVerses($verses);
        $devotionalium->setDate($date);

        return $devotionalium;
    }
}
