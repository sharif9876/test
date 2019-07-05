<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\MessageEntry;
use App\Message;
use App\Level;



class AdminMessagesController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    //messages
    public function messages() {
        $messages = Message::orderBy('level_min','desc')->get();
        (array) $messages;
        return view('admin/messages/messages', compact('messages'));
    }
    public function messageAdd() {
        $level_max=Level::max('level');
        $message_types=["global"=>1,"unique"=>0];
        $errors = session('errors');
        return view('admin/messages/messageAdd', compact('errors','level_max','message_types'));
    }
    public function messageEdit($id) {
        $level_max=Level::max('level');
        $message = Message::find($id);
        $message_types=["global"=>1,"unique"=>0];  
        $errors = session('errors');
        return view('admin/messages/messageEdit', compact('message',  'errors','level_max','message_types'));
    }
     public function messageDelete($id) {
        $message = Message::find($id);
        $message->delete();
        return redirect('/admin/messages');
   }
    public function messageAddSave(Request $request) {

        $level_max = Level::max('level');
        $validator = Validator::make($request->all(), [
            'message_title' => 'required|max:50',
            'message_message' => 'required|max:500',
            'message_global' => 'required|in:1,0',
            'message_level' => 'numeric|min:0|max:'.$level_max,


        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/messages/add'))->with('errors', $errors);
        }
        $level_min = $request->input('message_level');
        if($request->input('message_global')==0){
           $level_min = null;
        }
        Message::create([
            'title' => $request->input('message_title'),
            'message' => $request->input('message_message'),
            'level_min' => $level_min,
            'global' => $request->input('message_global')
        ]);
        return redirect(url('/admin/messages'));
    }
    public function messageEditSave(Request $request,$id) {
        $level_max = Level::max('level');
        $validator = Validator::make($request->all(), [
            'message_title' => 'max:50',
            'message_message' => 'max:500',
            'message_level' => 'numeric|min:0|max:'.$level_max
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/messages/'.$id.'/edit'))->with('errors', $errors);
        }
       
        $message = Message::find($id);
        $message->update([
            'title' => $request->has('message_title') ? $request->input('message_title') : $message->title,
            'message' => $request->has('message_message') ?  $request->input('message_message') : $message->message,
            'level_min' => $request->has('message_level') ? $request->input('message_level') : $message->level_min
        ]);
        return redirect(url('/admin/messages'));
    }


   //userMessages
    public function userMessages(){
    	 $userMessages = MessageEntry::all();
        (array) $userMessages;
        return view('admin/messages/userMessages', compact('userMessages'));
    }
     public function userMessageAdd() { 
        $errors = session('errors');
        return view('admin/messages/userMessageAdd', compact('errors'));
    }
    public function userMessageEdit($id) {
        $userMessage = MessageEntry::find($id);  
        $errors = session('errors');
        return view('admin/messages/userMessageEdit', compact('userMessage',  'errors'));
    }
    public function userMessageDelete($id) {
        $userMessage = MessageEntry::find($id);
        $message->delete();
        return redirect('/admin/messages/user');
   }
    public function userMessageAddSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'userMessage_user_id' => 'required|exists:users,id',
            'userMessage_message_id' => 'required|exists:messages,id'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/messages/user/add'))->with('errors', $errors);
        }

        MessageEntry::create([
            'user_id' => $request->input('userMessage_user_id'),
            'message_id' =>  $request->input('userMessage_message_id'),
            'opened' => 0
        ]);
        return redirect(url('/admin/messages/user'));
    }
    public function userMessageEditSave(Request $request, $id) {
        $validator = Validator::make($request->all(), [
           'userMessage_user_id' => 'required|exists:users,id',
           'userMessage_message_id' => 'required|exists:messages,id'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/messages/user/edit'))->with('errors', $errors);
        }
        $userMessage = MessageEntry::find($id);
      
        $userMessage->update([
            'user_id' => $request->has('userMessage_user_id') ? $request->input('userMessage_user_id') : $userMessage->user_id,
            'message' => $request->has('userMessage_message_id') ?  $request->input('userMessage_message_id') : $userMessage->message_id,
        ]);
        return redirect(url('/admin/messages/user'));
    }
}
