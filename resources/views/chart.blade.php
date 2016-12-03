<?php require(app_path().'/stockMarketAPI.php') ?>
<?php

$stockSymbol = $_GET["q"];

$start = '11-20-2016';
$end = date('m-d-Y');

$StockMarketAPI = new StockMarketAPI;
$StockMarketAPI->symbol = $stockSymbol;
$StockMarketAPI->history = array(
  'start' 	 => $start,
  'end' 	 => $end,
  'interval' => 'd' // Daily
);
$Symbol = $StockMarketAPI->symbol;

$data = $StockMarketAPI->getData();

echo json_encode($data[$Symbol]);
?>