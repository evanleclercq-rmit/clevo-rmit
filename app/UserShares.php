<?php

require(app_path().'/financeWebService.php');
require(app_path().'/DatabaseUtilities.php');

function calculateSharesValue($id)
{
    $totalValue = 0;
    $currentHoldings = getHoldings($id);
   
    if (count($currentHoldings) > 0)
        
    {
        foreach ($currentHoldings as $key=>$value)
        {
            $shareData = search_stock($value[0]);
            $shareValue = $shareData['price']*$value[1];
            $totalValue=$totalValue+$shareValue;
        }
    }
    
    return $totalValue;
}

function calculateAvgShareValue()
{
    $totalValue = 0;
    $numShares = 0;
    $currentHoldings = getHoldings(Auth::User()->id);
    
    if (count($currentHoldings) > 0)
    {
        foreach ($currentHoldings as $key=>$value)
        {
            $numShares=$numShares+$value;
            $shareData = search_stock($key);
            $shareValue = $shareData['price']*$value;
            $totalValue=$totalValue+$shareValue;
        }

        return $totalValue/$numShares;

    }
    
}
?>