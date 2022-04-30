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
    
    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getCertificateById(Request $request)
    {
        $certificate_id = $request->route('id');

        $certificate = Certificate::find($certificate_id);

        if (!$certificate) {
            return response()->json(["message" => "Certificate not found!"], 404);
        }

        return response()->json($certificate, 200);
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateCertificate($id, Request $request)
    {
        $this->validate($request, [
            'certificate_name' => 'required|max:255',
            'certificate_logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $certificate = Certificate::find($id);
        $certificate->certificate_name = $request->certificate_name ?? $certificate->certificate_name;
        $certificate->score_achievement = $request->score_achievement ?? $certificate->score_achievement;
        $certificate->from_date = $request->from_date ?? $certificate->from_date;
        $certificate->to_date = $request->to_date ?? $certificate->to_date;
        $certificate->is_continuing = $request->is_continuing ?? $certificate->is_continuing;
        $certificate->description = $request->description;

        if($request->file('certificate_logo')){
            if(!empty($certificate->certificate_logo)){
                unlink(public_path($certificate->certificate_logo));
            }

            $file= $request->file('certificate_logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/certificates/'), $filename);
            $certificate->certificate_logo = 'assets/img/certificates/'.$filename;
        }

        $certificate->save();

        return response()->json('Skill updated!');
    }
}
