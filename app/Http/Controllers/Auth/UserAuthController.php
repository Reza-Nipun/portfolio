<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'user_name' => 'required|unique:users,user_name',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }

    public function users(){
        return 'IN';
    }

    /**
     * @param $user_name
     * @return \Illuminate\Http\Response
     */
    public function user($user_name){
        $user = User::where('user_name', $user_name)->first();

        if(!$user){
            return response()->json(['message' => 'Not Found!'], 404);
        }

        return response()->json($user, 200);
    }

    public function me()
    {
        return response()->json(
            Auth::user()
        );
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'resume' => 'mimes:doc,docx,pdf|max:5000',
            'profile_pic' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $id = Auth::user()->id;
        
        $user = User::find($id);
        $user->name = $request->name ?? $user->name;
        $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->address = $request->address ?? $user->address;
        $user->profile_picture = $request->profile_picture ?? $user->profile_picture;
        $user->cover_photo = $request->cover_photo ?? $user->cover_photo;
        $user->profile_title = $request->profile_title ?? $user->profile_title;
        $user->about_me = $request->about_me ?? $user->about_me;

        if ($file = $request->file('resume')) {
            if(!empty($user->resume)){
                Storage::delete($user->resume);
            }

            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
 
            $user->resume = $path;
        }
        
        if($request->file('profile_pic')){
            if(!empty($user->profile_picture)){
                unlink(public_path($user->profile_picture));
            }

            $file= $request->file('profile_pic');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/profile_photos/'), $filename);
            $user->profile_picture = 'assets/img/profile_photos/'.$filename;
        }

        $user->save();

        return response()->json($user);
    }

    public function downloadFile(Request $request)
    {
        return Storage::download($request->file);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
