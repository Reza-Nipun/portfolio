<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userTags($user_id){
        $tags = Tag::where('user_id', $user_id)->where('status', 1)->get();

        return response()->json($tags, 200);
    }
}
