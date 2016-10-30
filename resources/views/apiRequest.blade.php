
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
        
            $stockData = array(
                 "name" => $json['query']['results']['quote']['Name'],
                 "price" => $json['query']['results']['quote']['Ask'],
                 "currency" => $json['query']['results']['quote']['Currency'],
                 "change" => $json['query']['results']['quote']['Change'],
            );
            
            if($stockData['name']!=null)
            {
                 echo "<br><li>Company : ".$stockData['name']."</li><li>Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$stockData['price']."</li><li>Currency  : ".$stockData['currency']."</li><li>Change   &nbsp;&nbsp; : ".$stockData['change']."</li>";
            }
            else
            {
                echo "<br>Company not found";
            }
           

    


       
   
?>

