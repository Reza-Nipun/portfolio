<?php

namespace App\Http\Controllers;

use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{
   /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userLinks($user_id)
    {
        $links = Links::where('user_id', $user_id)->get();

        return response()->json($links, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseLinks(Request $request)
    {
        $user_id = Auth::user()->id;

        $limit  = $request->limit ?? 10;
        
        $links = Links::where('user_id', $user_id)->paginate($limit);

        return response()->json($links, 200);
    }
}
