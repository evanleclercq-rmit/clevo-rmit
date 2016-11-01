Transactions Testing
<br><br>

<?php

    require(app_path().'\DatabaseUtilities.php');

    $user = (Auth::User());
    echo $user;
    // echo ("<br><br>");
    // echo ($user->name);

    // echo (Auth::User()->holdings);


    //Need to store id and current holdings of logged in user
    $id = Auth::User()->id;
    $holdings = getHoldings($id);
    echo (rtrim (Auth::User()->holdings, ","));
    print_r ($holdings);

    // updateBalance($id, 20000);
    // echo Auth::User()->balance;
    // $holdingsnew = "cba,100,ahl,50,ori,500";

    // updateHoldings ($id, $holdings);

    //Updates the holdings field in the db for specified user.
 ?>