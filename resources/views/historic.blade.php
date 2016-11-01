<?php require(app_path().'/stockMarketAPI.php') ?>
<?php

$stockSymbol = $_GET["q"];

$start = '10-21-2016';
$end = '14-31-2016';
?>
<?php
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