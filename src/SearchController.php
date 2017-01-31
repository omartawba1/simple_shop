<?php

namespace Tawba\Shop;

use Tawba\Shop\Services\FlipkartService;
use Tawba\Shop\Services\ShopService;

class SearchController
{
    /**
     * The search query
     * @var $query
     */
    private $query;

    /**
     * The storage file path
     * @var string $file_path
     */
    private $file_path = "storage/results.json";

    
    /**
     * The constructor to set the search variable
     *
     * @param $query
     *
     * @return void
     */
    public function __construct($query)
    {
        $this->query = $query;
    }
    
    /**
     * Parsing the webservices and return the results
     *
     * @return array
     */
    public function getResults()
    {
        $all_results = $this->parseWebservices();
        $all_results = $this->refactorResults($all_results);
        $this->saveResults($all_results);
        
        return $all_results;
    }
    
    /**
     * Parsing the webservices and return ASC Sorted array
     *
     * @return array
     */
    private function parseWebservices()
    {
        // The Shop Webservice
        $shop_service          = new ShopService($this->query);
        $shop_service_products = $shop_service->parseShopService();
        
        // The FlipKart webservice
        $flip_service          = new FlipkartService($this->query);
        $flip_service_products = $flip_service->parseFlipService();
        
        // Sorting the results
        $all_results = array_merge($shop_service_products, $flip_service_products);
        usort($all_results, "sort_by_price");

        return $all_results;
    }
    
    /**
     * Appending the results to the storage JSON file
     *
     * @param $results
     */
    private function saveResults($results)
    {
        $current_data  = file_get_contents($this->file_path);
        $current_array = json_decode($current_data, true);
        array_push($current_array, $results);
        $jsonData = json_encode($current_array);
        file_put_contents($this->file_path, $jsonData);
    }

    /**
     * Refactor the results for saving them
     *
     * @param $all_results
     *
     * @return mixed
     */
    private function refactorResults($all_results)
    {
        foreach ($all_results as &$single_result) {
            $single_result['price'] .= " USD";
            $single_result['msrp']  .= " USD";
        }

        return $all_results;
    }
    
}
