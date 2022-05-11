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

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getLinkById(Request $request)
    {
        $link_id = $request->route('id');

        $link = Links::find($link_id);

        if (!$link) {
            return response()->json(["message" => "Link not found!"], 404);
        }

        return response()->json($link, 200);
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateLink($id, Request $request)
    {
        $link = Links::find($id);
        $link->url_link = $request->url_link ?? $link->url_link;
        $link->link_type = $request->link_type ?? $link->link_type;
        $link->save();

        return response()->json('Tag updated!');
    }
}
