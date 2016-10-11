<html>
<head>
    <?php
        require ('financeWebService.php');
    ?>
</head>
<body>
    
     <form  name="APIsearchForm" action="<?php echo basename ($_SERVER["PHP_SELF"]); ?>" method="post">
        <input name="searchText" placeholder=" Enter stock symbol" type="text"?>   
        <button class="submitButt" type="submit" value="Submit">Search</button>
    </form>
    
</body>
<?php
    if(isset($_POST)&&!empty($_POST))
    {
        $stockSymbol = $_POST['searchText'];
        
       
        $stockData = search_stock($stockSymbol);
        
        foreach ($stockData as $key => $value)
        {
            echo $key, " :", $value, "<br>";      
        }
    }
    
?>


</html>