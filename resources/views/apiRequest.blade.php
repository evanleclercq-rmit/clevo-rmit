
<?php
$stockSymbol = $_GET["q"];
            $cSession = curl_init(); 
            
            $queryURL = 
"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22".$stockSymbol."%22)&format=json&env=store://datatables.org/alltableswithkeys";
            
            curl_setopt($cSession,CURLOPT_URL,$queryURL);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);    
            
            $result = curl_exec($cSession);

            curl_close($cSession);
        
            $json = json_decode($result, true);
            
            $companyData = json_encode($json['query']['results']['quote']);
            echo $companyData;  
   
?>

