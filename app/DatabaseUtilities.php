 <?php

    //Updates the holdings field in the db for specified user.
    function updateHoldings($id, $holdings) {
        $holdingscsv = '';

        for ($i = 0; $i < count($holdings); $i++) {
            $holdingscsv = $holdingscsv . $holdings[$i] . ',';
        }
        DB::table('users')
            ->where('id', $id)
            ->update(['holdings' => $holdingscsv]);
    }

    //Returns an array of current holdings
    function getHoldings ($id) {
        $currentarray = explode (',', (rtrim (Auth::User()->holdings, ",")));
        $current = array();
        for ($i = 0; $i < count($currentarray); $i = $i+2) {
            $current[$currentarray[$i]] = $currentarray[$i+1];
        }

        return $current;
    }

    //Update the specified field for specified user
    function updateDBField ($id, $field, $update) {
        DB::table('users')
            ->where ('id',$id)
            ->update([$field -> $update]);
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
            ->update(['balance' -> $balance]);
    }

?>