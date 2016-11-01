 <?php

    //Updates the holdings field in the db for specified user.
    function updateHoldings($id, $holdings) {
        $holdingscsv = '';

        foreach ($holdings as $key=>$value){
            $holdingscsv = $holdingscsv . $key.','.$value.',';
        }

        echo ("csv=".$holdingscsv);

        DB::table('users')
            ->where('id', $id)
            ->update(['holdings' => $holdingscsv]);
    }

    //Returns an array of current holdings
    function getHoldings ($id) {
        $current = array();
        if (Auth::User()->holdings != null) {
            $currentarray = explode (',', (rtrim (Auth::User()->holdings, ",")));
            for ($i = 0; $i < count($currentarray); $i = $i+2) {
                $current[$currentarray[$i]] = $currentarray[$i+1];
            }
        }
        return $current;
    }

    //Update the specified field for specified user
    function updateDBField ($id, $field, $update) {
        DB::table('users')
            ->where ('id',$id)
            ->update([$field => $update]);
    }

    //Get specified field for specified user
    function getDBField ($id, $field) {
        DB::table('users')
            ->where ('id', $id)
            ->value ($field);
    }

    //Update Balance for specified user
    function updateBalance ($id, $balance) {
        DB::table ('users')
            ->where ('id', $id)
            ->update(['balance' => $balance]);
    }

    function getBalance ($id) {
        return DB::table('users')
            ->where ('id', $id)
            ->value ('balance');
    }

?>