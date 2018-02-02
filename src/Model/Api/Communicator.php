<?php

namespace Devotionalium\Model\Api;

class Communicator
{
    const ENDPOINT_API_V1 = 'https://stage.devotionalium.com/api/v1';
    const ENDPOINT_API_V2 = 'https://stage.devotionalium.com/api/v2';

    const PARAM_LANGUAGE = 'lang';
    const LANGAUGE_EN = 'en';
    const LANGUAGE_DE = 'de';

    const PARAM_VERSION = 'version';
    const VERSION_KINGJAMES = 'kjv';
    const VERSION_WORLDENGLISH = 'web';
    const VERSION_ELBERFELDER = 'elb';
    const VERSION_LUTHER = 'lut';
    const VERSION_SCHLACHTER = 'schla';

    const PARAM_DAYOFFSET = 'dayOffset';

    const ACTION_VERSIONS = 'versions';
    const ACTION_DEVOTIONALIUM = 'devotionalium';

    const ACTIONS = [
        self::ACTION_VERSIONS,
        self::ACTION_DEVOTIONALIUM,
    ];

    /**
     * @var string
     */
    private $endpoint;

    /**
     * Communicator constructor.
     *
     * @param string $endpoint
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param array $parameters
     * @param string $action
     * @return mixed[]
     */
    public function get(array $parameters, $action = '')
    {
        if (in_array($action, self::ACTIONS)) {
            $action = '/'.$action;
        } else {
            $action = '';
        }
        $url = $this->endpoint.$action.'?'.http_build_query($parameters);
        $response = $this->makeRequest($url);

        return $response;
    }

    /**
     * @param $url
     * @return array
     * @throws \Exception
     */
    private function makeRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $headers = $this->getHeaders($response);
        $body = $this->getBody($response);

        if (strpos($headers['httpCode'], '200') === false) {
            throw new \Exception('Error connecting to server');
        }

        return $body;
    }

    /**
     * @param string $response
     * @return array
     */
    private function getHeaders($response)
    {
        $headers = array();
        $headerText = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $headerText) as $i => $line) {
            if ($i === 0) {
                $headers['httpCode'] = $line;
            } else {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }
        }

        return $headers;
    }

    /**
     * @param $response
     * @return array
     */
    private function getBody($response)
    {
        $parts = explode("\r\n", $response);
        $body = array_pop($parts);

        return json_decode($body, true);
    }
}
