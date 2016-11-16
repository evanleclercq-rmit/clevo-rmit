 <?php

    //Updates the holdings field in the db for specified user.
    function updateHoldings($id, $holdings) {
        $holdingscsv = '';

        foreach ($holdings as $key=>$value){
            $holdingscsv = $holdingscsv . $key.',';
            foreach($value as $key2=>$value2)
                $holdingscsv = $holdingscsv.$value2.',';
        }

        // echo ("csv=".$holdingscsv);

        DB::table('users')
            ->where('id', $id)
            ->update(['holdings' => $holdingscsv]);
    }

    //Returns an array of current holdings
    function getHoldings ($id) {
        $user = DB::table('users')->where('id', $id)->first();
        $current = array();
        if ($user->holdings != null) {
            $currentarray = explode (',', (rtrim ($user->holdings, ",")));
       
            
            for ($j = 0, $i = 0; $i < count($currentarray); $i = $i+3) {
                $current[$currentarray[$i]][$j] = $currentarray[$i+1];
                $current[$currentarray[$i]][$j+1] = $currentarray[$i+2];
                
                
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