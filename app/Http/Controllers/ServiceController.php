<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userServices($user_id)
    {
        $skills = Service::where('user_id', $user_id)
                ->orderBy('from_date', 'DESC')
                ->orderBy('to_date', 'DESC')
                ->get();

        return response()->json($skills, 200);
    }
}
