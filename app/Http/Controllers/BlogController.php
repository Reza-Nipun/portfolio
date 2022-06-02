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

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getBlogById(Request $request)
    {
        $blog_id = $request->route('id');

        $blog = Blog::find($blog_id);

        if(!$blog) {
            return response()->json(['message' => 'Blog not found!']);
        }

        return response()->json($blog, 200);
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateBlog($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'blog_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title ?? $blog->title;
        $blog->blog_url = $request->blog_url;
        $blog->description = $request->description;
        $blog->status = $request->status ?? $blog->status;

        if($request->file('blog_image')){
            if(!empty($blog->blog_image)){
                unlink(public_path($blog->blog_image));
            }

            $file= $request->file('blog_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/blogs/'), $filename);
            $blog->blog_image = 'assets/img/blogs/'.$filename;
        }

        $blog->save();

        return response()->json('Blog updated!');
    }
}
