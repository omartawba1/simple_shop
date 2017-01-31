<?php

namespace Tawba\Shop\Services;

class FlipkartService
{
    /**
     * The search query
     * @var $query
     */
    private $query;
    
    /**
     * API Affiliate ID
     * @var string
     */
    private $affiliateId = "omartawba";
    
    /**
     * The API Token
     * @var string
     */
    private $token = "324165646dee46a7b688e77412e58f6a";
    
    /**
     * The response type "json or XML"
     * @var string
     */
    private $response_type = "json";
    
    /**
     * The API base URL
     * @var string
     */
    private $api_base = 'https://affiliate-api.flipkart.net/affiliate/1.0/search.json?query=';
    
    /**
     * Set the search query
     *
     * @return void
     **/
    function __construct($query)
    {
        $this->query = urlencode($query);
    }
    
    /**
     * Calls the API directory page and returns the response.
     *
     * @return string Response from the API
     **/
    public function parseFlipService()
    {
        $output = $this->sendRequest($this->api_base);
        
        return $this->prepareResults($output);
    }
    
    /**
     * Preparing the results and get only the target data
     *
     * @param $output
     *
     * @return array
     */
    private function prepareResults($output)
    {
        $converter      = new CurrencyConverter("INR", "USD");
        $search_results = [];
        foreach ($output as $product) {
            $item['name']       = $product['productBaseInfoV1']['title'];
            $item['image_url']  = $product['productBaseInfoV1']['imageUrls']['200x200'];
            $item['price']      = $converter->convert($product['productBaseInfoV1']['flipkartSpecialPrice']['amount']);
            $item['msrp']       = $converter->convert($product['productBaseInfoV1']['flipkartSellingPrice']['amount']);
            $item['percentage'] = (string)(($item['msrp'] - $item['price']) / $item['msrp'] * 100) . '%';
            
            $search_results[] = $item;
        }
        
        return $search_results;
    }
    
    /**
     * Sends the HTTP request using cURL.
     *
     * @param string $url The URL for the API
     *
     * @return string Response from the API
     **/
    private function sendRequest($url)
    {
        //The headers are required for authentication
        $headers = [
            'Cache-Control: no-cache',
            'Fk-Affiliate-Id: ' . $this->affiliateId,
            'Fk-Affiliate-Token: ' . $this->token,
        ];
        $url .= $this->query;
        $connection     = new Connector($url, $headers);
        $request_result = $connection->run();

        return !empty($request_result['productInfoList']) ? $request_result['productInfoList'] : [];
    }
    
}