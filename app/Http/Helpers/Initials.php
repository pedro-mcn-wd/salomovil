<?php

namespace App\Http\Helpers;

class Initials {
    public static function initials($name)
    {
        $initials = null;
        $words = explode(" ", $name);
        $words_cont = count($words);

        if($words_cont==1){
            $initials .= strtoupper($words[0][0]);
        }else{
            $initials .= strtoupper($words[0][0]);
            $initials .= strtoupper($words[1][0]);
        }

        return $initials;
    }
}
