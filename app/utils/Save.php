<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

trait Save
{
    static public function createWithAll($data_model){

        $add_data = [
            'id_user_created'   => Auth::user()->id,
            'id_user_updated'   => Auth::user()->id,
            'created_by'        => Auth::user()->name,
            'updated_by'        => Auth::user()->name,
            'created_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City')
        ];

        $result = array_merge($data_model, $add_data);

        return parent::create($result);
    }
}