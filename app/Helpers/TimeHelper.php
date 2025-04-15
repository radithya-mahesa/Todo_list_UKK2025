<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function getGreeting()
    {   
        //ambil jam berdasarkan angka
        $hour = Carbon::now()->hour;

        if ($hour >= 5 && $hour < 11) {
            return 'Good Morning!';
        } elseif ($hour >= 11 && $hour < 17) {
            return 'Good Afternoon!';
        } elseif ($hour >= 17 && $hour < 21) {
            return 'Good Evening!';
        } else {
            return 'Good Night!';
        }
    }
}
