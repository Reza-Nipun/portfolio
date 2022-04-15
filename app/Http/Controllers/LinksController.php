<?php

namespace App\Http\Controllers;

use App\Models\Links;
use Illuminate\Http\Request;

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
}
