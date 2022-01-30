<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function senderMessage(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required|max:255|nullable',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'nullable',
        ]);

        $user = User::find($request->input('user_id'));

        if(!$user){
            return response()->json(['message' => 'User Not Found'], 404);
        }

        $mail_data = [
            'to_email' => $user->email,
            'reciever_name' => $user->name,
            'sender_email' => $request->email,
            'sender_name' => $request->name,
            'subject' => $request->subject,
            'message_body' => $request->message,
        ];

        $data = $request->all();
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        Contact::insert($data);

        Mail::send('contact_me', $mail_data, function($message) use($mail_data)
        {
            $message
                ->to($mail_data['to_email'])
                ->from($mail_data['sender_email'], $mail_data['sender_name'])
                ->subject($mail_data['subject'] ?? 'Portfolio - Message from '.$mail_data['sender_name']);
        });

        return response()->json(['message' => 'Successfully Message Sent'], 200);
    }
}
