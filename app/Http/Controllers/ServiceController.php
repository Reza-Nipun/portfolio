<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userServices($user_id)
    {
        $services = Service::where('user_id', $user_id)
                ->orderBy('from_date', 'DESC')
                ->orderBy('to_date', 'DESC')
                ->get();

        return response()->json($services, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseServices(Request $request)
    {
        $user_id = Auth::user()->id;

        $limit  = $request->limit ?? 10;

        $services = Service::where('user_id', $user_id)
                    ->orderBy('from_date', 'DESC')
                    ->orderBy('to_date', 'DESC')
                    ->paginate($limit);

        return response()->json($services, 200);
    }
}
