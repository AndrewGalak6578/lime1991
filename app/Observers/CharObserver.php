<?php

namespace App\Observers;

use App\Models\Char;

class CharObserver
{
    public function deleted(Char $char): void
    {
        $char->values()->delete();
    }
}
