<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaseService
{
    public function dayOfweek($dateTxt)
    {
        return \Carbon\Carbon::parse($dateTxt)->locale('pt_BR')->isoFormat('dddd');
    }
}