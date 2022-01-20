<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

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
}
