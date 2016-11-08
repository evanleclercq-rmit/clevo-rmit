<?php

require(app_path().'/financeWebService.php');
require(app_path().'/DatabaseUtilities.php');

function calculateSharesValue()
{
    $totalValue = 0;
    $currentHoldings = getHoldings(Auth::User()->id);
    
    if (count($currentHoldings) > 0)
    {
        foreach ($currentHoldings as $key=>$value)
        {
            $shareData = search_stock($key);
            $shareValue = $shareData['price']*$value;
            $totalValue=$totalValue+$shareValue;
        }
    }
    
    return $totalValue;
}
?>