<?php

namespace Tawba\Shop\Services;

class CurrencyConverter
{
    /**
     * The API base URL
     * @var string
     */
    private $base_url = "http://www.google.com/finance/converter?a=";
    
    /**
     * The Currency that you want to convert
     * @var string $from_currency
     */
    private $from_currency;
    
    /**
     * The currency that you want to convert to
     * @var string $to_currency
     */
    private $to_currency;
    
    /**
     * CurrencyConverter constructor.
     */
    public function __construct($from_currency, $to_currency)
    {
        $this->from_currency = urlencode($from_currency);
        $this->to_currency   = urlencode($to_currency);
    }
    
    /**
     * Converting the currency
     * @return float
     */
    public function convert($amount)
    {
        $url            = $this->base_url . urlencode($amount) . "&from=" . $this->from_currency . "&to=" . $this->to_currency;
        $connection     = new Connector($url);
        $request_result = $connection->run();
        
        $data = explode('bld>', $request_result);
        $data = (!empty($data[1]) && !empty(explode($this->to_currency, $data[1]))) ? explode($this->to_currency,
            $data[1]) : ['0.99'];
        
        return round($data[0], 4);
    }
    
}
