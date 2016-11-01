
<?php
    function search_stock($stockSymbol)
    {
            $cSession = curl_init();

            $queryURL =
"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22".$stockSymbol."%22)&format=json&env=store://datatables.org/alltableswithkeys";

            curl_setopt($cSession,CURLOPT_URL,$queryURL);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);

            $result = curl_exec($cSession);

            curl_close($cSession);

            $json = json_decode($result, true);

            $stockData = array(
                 "name" => $json['query']['results']['quote']['Name'],
                 "price" => $json['query']['results']['quote']['Ask'],
                 "currency" => $json['query']['results']['quote']['Currency'],
                 "changeFromYearHigh" => $json['query']['results']['quote']['PercebtChangeFromYearHigh'],
                 "change" => $json['query']['results']['quote']['Change'],
                 "graph" => "<img src='http://chart.finance.yahoo.com/z?s=".$stockSymbol."&t=6m&q=l&l=on&z=s&p=m50,m200'>",
                 "symbol" => $json['query']['results']['quote']['symbol']
            );

            return $stockData;

    }





?>