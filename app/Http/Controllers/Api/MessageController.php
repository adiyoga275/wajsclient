<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    function store(Request $request) {
        
        try {
            if(isset($request->file)){
                $mimeToExtension = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                    // Add more MIME types as needed
                ];
                
                // Get the file extension based on the MIME type
                $extension = isset($mimeToExtension[$request->mimetype]) ? $mimeToExtension[$request->mimetype] : null;

                $decodedData = base64_decode($request->file);
                // Determine the storage directory
                $storagePath = storage_path('app/public/attachment/'); // Change this to your desired storage path
                // Generate a random filename
                $randomFilename = now()->timestamp.'_'.Str::random(5)."." . $extension; // Adjust the length and file extension as needed

                // Save the decoded data to a file
                file_put_contents($storagePath . $randomFilename, $decodedData);


               $message =  Message::create([
                    'phone' => $request->phone,
                    'name'  => $request->name,
                    'type' => $request->type,
                    'body'  => $request->body,
                    'attachment_type' => $request->mimetype,
                    'attachment_link' => "attachment/".$randomFilename,
                ]);
            }else{
                $message =  Message::create([
                    'phone' => $request->phone,
                    'name'  => $request->name,
                    'type' => $request->type,
                    'body'  => $request->body,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $message
            ]);
           
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'Error '.$th->getMessage(),
            ]);
        }
    }

    function recentMessage() {
        $contacts =  Message::select('phone', DB::raw('MAX(body) as body'), DB::raw('MAX(name) as name'), DB::raw('MAX(created_at) as created_at'))->groupBy('phone')->get();
        $result = [];
        foreach ($contacts as $c) {
            $result[] = array(
                "phone" => $c->phone,
                "name" => $c->name,
                "avatar" => url('assets')."/images/users/avatar-2.jpg",
                "lastMessage" => substr($c->body, 0,10),
                "lastMessageTime" =>  Carbon::parse($c->created_at)->diffForHumans()
            );
        }
        
        return $result;
    }

    function messageByPhone($phone) {

        $messages = Message::where('phone', $phone)->get();

        foreach ($messages as $c) {
            $result[] = array(
                "date" => Carbon::parse($c->created_at)->format('Y-m-d'),
                "isRight" => true,
                "sender" => $c->name,
                "text" => $c->body,
                "time" => Carbon::parse($c->created_at)->format('H:i')
            );
        }
       

        return $result ?? [];
    }

    function sendMessage(Request $request) {
        $sendMessageResponse = [
            "status" => "success",
            "message" => [
                "date" => "Today",
                "isRight" => true,
                "sender" => "Your Username",
                "text" => "Your new message",
                "time" => date("H:i")  // Current time
            ]
        ];

        return $sendMessageResponse;
    }
}
