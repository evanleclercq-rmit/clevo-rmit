 <?php

    function updateWatchlist($user, $symbol, $name) {
        $currentString = getWatchlist($user->id); 
        // If not first company to be saved
        if ($currentString != null){
            $newString = $currentString . "&" . $symbol . "=" . $name ;
        }
        // If first symbol to be saved
        else {
            $newString = $symbol . "=" . $name;
        //TODO: check for duplicates
        }
        DB::table('users')
            ->where('id', $user->id)
            ->update(['watchlist' => $newString]);
    }

    function getWatchlist ($id) {
        $watchlist = Auth::User()->watchlist;
        return $watchlist;
    }

    function removeCompany($user, $symbol) {
        $watchlist = getWatchlist($user->id);

        // If only entry resets string
        if (substr_count($watchlist, ".AX")==1)
         {
            $updatedWatchlist = "";
         }

        // Deletes string from Symbol to next '&' separator
         else {
            $updatedWatchlist = delete_all_between($symbol, '&', $watchlist);
         }
         
         //TOFIX: can't delete the last object of string

        // Updates table with new string
        DB::table('users')
                    ->where('id', $user->id)
                    ->update(['watchlist' => $updatedWatchlist]);
}

    // Deletes part of string between two points. Used in removeCompany()
    function delete_all_between($beginning, $end, $string) {
      $beginningPos = strpos($string, $beginning);
      $endPos = strpos($string, $end);
      if ($beginningPos === false || $endPos === false) {
        return $string;
      }
      $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
      return str_replace($textToDelete, '', $string);
    }
  
    
?>  