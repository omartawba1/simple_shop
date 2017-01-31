<?php

require "vendor/autoload.php";

use Tawba\Shop\SearchController;

$qeury = $_GET['query'];

$search = new SearchController($qeury);

echo json_encode($search->getResults());
