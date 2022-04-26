<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userBlogs($user_id)
    {
        $blogs = Blog::where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();

        return response()->json($blogs, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseBlogs(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $sort = $request->sort ?? 'id';
        $order = $request->order ?? 'DESC';
        $limit  = $request->limit ?? 10;

        $blogs = Blog::where('user_id', $user_id)
                ->orderBy($sort, $order)
                ->paginate($limit);

        return response()->json($blogs, 200);
    }
}
