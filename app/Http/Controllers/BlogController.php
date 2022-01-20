<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

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
}
