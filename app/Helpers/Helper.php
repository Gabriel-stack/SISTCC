<?php

namespace App\Helpers;

use App\Models\Professor;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function manager()
    {
        $manager = Professor::find(Auth::guard('professor')->user()->id);

        return $manager;
    }
}
