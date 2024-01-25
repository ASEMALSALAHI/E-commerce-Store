<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class user_ContactController extends Controller
{
    public function addmessage (Request $request){
        $message = new Contact();
        $message->user_id = $request->user_id;
         $message->name = $request->name;
         $message->email = $request->email;
         $message->message = $request->message;
         $message->contact_date =date('Y-m-d');
         $message->contact_time =date('H:i:s');
         $message->save();
         return response()->json(['status'=> 201, 'message'=> 'Your message has been sent',]);

    }
    //
}
