<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userCertificates($user_id)
    {
        $certificates = Certificate::where('user_id', $user_id)
                ->orderBy('from_date', 'ASC')
                ->orderBy('to_date', 'ASC')
                ->get();

        return response()->json($certificates, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseCertificates(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $limit  = $request->limit ?? 10;

        $certificates = Certificate::where('user_id', $user_id)
                        ->orderBy('from_date', 'ASC')
                        ->orderBy('to_date', 'ASC')
                        ->paginate($limit);

        return response()->json($certificates, 200);
    }
}
