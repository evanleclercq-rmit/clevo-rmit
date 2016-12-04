<?php require(app_path().'/stockMarketAPI.php')

// Makes API request for historical stock data to 
// create price charts on dashboard and transactions pages

?>

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