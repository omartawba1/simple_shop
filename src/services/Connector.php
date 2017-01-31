<?php

namespace Tawba\Shop\Services;

class Connector
{
    /**
     * The API URL
     * @var string $url
     */
    public $url;
    
    /**
     * The API Request Headers
     * @var array $headers
     */
    public $headers;

    /**
     * Connector constructor to set the API URL & Headers.
     *
     * @param       $url
     * @param array $headers
     */
    public function __construct($url, $headers = [])
    {
        $this->url     = $url;
        $this->headers = $headers;
    }

    /**
     * Executing the API Call
     *
     * @return array
     */
    public function run()
    {
        $ch  = curl_init();
        $url = $this->url;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

}