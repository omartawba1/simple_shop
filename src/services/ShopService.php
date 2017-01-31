<?php

namespace Tawba\Shop\Services;

class ShopService
{
    /**
     * The webservice URL
     * @var string
     */
    private $url = 'https://api.shop.com/sites/v1/search/term/';
    
    /**
     * The search query
     * @var string
     */
    private $query;
    
    /**
     * ShopService constructor.
     *
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }
    
    /**
     * Parsing the webservice and returning the results
     *
     * @return array
     */
    public function parseShopService()
    {
        $output = $this->sendRequest();
        
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
        $search_results = [];
        
        foreach ($output as $product) {
            $item['name']       = $product['caption'];
            $item['image_url']  = $product['thumbURI'];
            $item['price']      = getFloat($product['priceInfo']['price']);
            $item['msrp']       = !empty($product['priceInfo']['maxPrice']) ? getFloat($product['priceInfo']['maxPrice']) : $item['price'];
            $item['percentage'] = (string)(($item['msrp'] - $item['price']) / $item['msrp'] * 100) . '%';
            
            $search_results[] = $item;
        }
        
        return $search_results;
    }
    
    /**
     * Sending the request to the API
     *
     * @return array
     */
    private function sendRequest()
    {
        $queryParams    = urlencode($this->query) . '?' . urlencode('apikey') . '=' . urlencode('l7xx465038ca43df42c2a17be2e6e6215b23');
        $url            = $this->url . $queryParams;
        $connection     = new Connector($url);
        $request_result = $connection->run();
        
        return !empty($request_result['searchItems']) ? $request_result['searchItems'] : [];
    }
    
}