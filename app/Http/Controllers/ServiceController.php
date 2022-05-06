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

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getServiceById(Request $request)
    {
        $service_id = $request->route('id');

        $service = Service::find($service_id);

        if (!$service) {
            return response()->json(["message" => "Service not found!"], 404);
        }

        return response()->json($service, 200);
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateService($id, Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'company_logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = Service::find($id);
        $service->company_name = $request->company_name ?? $service->company_name;
        $service->company_website = $request->company_website ?? $service->company_website;
        $service->company_address = $request->company_address ?? $service->company_address;
        $service->company_contact_info = $request->company_contact_info ?? $service->company_contact_info;
        $service->designation = $request->designation ?? $service->designation;
        $service->from_date = $request->from_date ?? $service->from_date;
        $service->to_date = $request->to_date ?? $service->to_date;
        $service->is_continuing = $request->is_continuing ?? $service->is_continuing;
        $service->type = $request->type ?? $service->type;
        $service->job_description = $request->job_description;

        if($request->file('company_logo')){
            if(!empty($service->company_logo)){
                unlink(public_path($service->company_logo));
            }

            $file= $request->file('company_logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/company_logos/'), $filename);
            $service->company_logo = 'assets/img/company_logos/'.$filename;
        }

        $service->save();

        return response()->json('Service updated!');
    }
}
