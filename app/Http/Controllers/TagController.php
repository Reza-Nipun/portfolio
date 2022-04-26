<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userTags($user_id)
    {
        $tags = Tag::where('user_id', $user_id)->where('status', 1)->get();

        return response()->json($tags, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseTags(Request $request)
    {
        $user_id = Auth::user()->id;

        $sort = $request->sort ?? 'id';
        $order = $request->order ?? 'DESC';
        $limit  = $request->limit ?? 10;

        $tags = Tag::where('user_id', $user_id)->orderBy($sort, $order)->paginate($limit);

        return response()->json($tags, 200);
    }
}
