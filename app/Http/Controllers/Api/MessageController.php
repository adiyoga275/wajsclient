<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $payload = $request->json()->all();
            $client = Client::where('deviceId', $payload['deviceId'])->first();
            Contact::updateOrCreate([
                'clientId' =>  $client->id,
                'contactId' => $payload['chatId'],
            ], [
                'isGroup' => $payload['isGroup'],
                'name' => isset($payload['name']) ? $payload['name'] : $payload['chatId'] ,
                'avatar' => isset($payload['avatar']) ? $payload['avatar'] : NULL,
                'lastMessage' => substr($payload['onChat'][0]['body'], 0, 40) ?? NULL,
                'timestamp' => $payload['onChat'][0]['timestamp'] ?? NULL,
            ]);

            foreach ($payload['onChat'] as $v) {
                $messages = [];
                if (!Message::where('timestamp', $v['timestamp'])->where('from', $v['from'])->exists()) {
                    if (isset($v['hasMedia'])) {
                        if ($v['hasMedia'] == true) {
                            if(isset($v['mediaFile'])){
                            $mimeToExtension = [
                                'image/jpeg' => 'jpg',
                                'image/png' => 'png',
                                'image/gif' => 'gif',
                                'video/mp4' => 'mp4',
                                'audio/ogg; codecs=opus' => 'ogg',
                                'image/webp' => 'webp'
                                // Add more MIME types as needed
                            ];

                            // Get the file extension based on the MIME type
                            $extension = isset($mimeToExtension[$v['mediaFile']['mimetype']]) ? $mimeToExtension[$v['mediaFile']['mimetype']] : null;

                            $decodedData = base64_decode($v['mediaFile']['data']);
                            // Determine the storage directory
                            $storagePath = storage_path('app/public/attachment/'); // Change this to your desired storage path
                            // Generate a random filename
                            $randomFilename = now()->timestamp . '_' . Str::random(5) . "." . $extension; // Adjust the length and file extension as needed

                            // Save the decoded data to a file
                            file_put_contents($storagePath . $randomFilename, $decodedData);
                            $messages['attachmentType'] = $v['mediaFile']['mimetype'];
                            $messages['attachmentLink'] = "attachment/" . $randomFilename;
                            }
                        }
                    }

                    $messages = array_merge($messages, array(
                        'ack' => isset($v['ack']) ? $v['ack'] : NULL,
                        'chatId' => $payload['chatId'],
                        'from' => $v['from'],
                        'to' => isset($v['to']) ? $v['to'] : NULL,
                        'type' => $v['type'],
                        'body' => $v['body'],
                        'fromMe' => $v['fromMe'],
                        'deviceType' => $v['deviceType'],
                        'timestamp' => $v['timestamp'],
                        'isRead' => 0
                    ));

                    Message::create($messages);
                    DB::commit();
                }
            }
            return response()->json([
                'status' => true,
                'message' => "Success"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Failed " . $th->getMessage()
            ]);
        }
    }


    function recentMessage()
    {
        // $contacts =  Message::select('phone', DB::raw('MAX(body) as body'), DB::raw('MAX(name) as name'), DB::raw('MAX(created_at) as created_at'), DB::raw('MAX(id) as id'))
        // ->groupBy('phone')
        // ->orderBy('id', "DESC")
        // ->get();

        $contacts = Contact::all();
        $result = [];
        foreach ($contacts as $c) {
            $result[] = array(
                "phone" => $c->contactId,
                "name" => $c->name,
                "avatar" => $c->avatar,
                "lastMessage" => $c->lastMessage,
                "lastMessageTime" =>  $c->timestamp
                // "lastMessage" => $this->checkLastMessage($c->contactId),
                // "lastMessageTime" =>  Carbon::parse($c->created_at)->diffForHumans()
            );
        }

        return response()->json(mb_convert_encoding($result, "UTF-8", "auto"));
    }

    function checkLastMessage($phone)
    {
        $message = Message::where('chatId', $phone)->where('type', 'chat')->orderBy('timestamp', 'desc')->whereNotNull('body')->first();
        return substr($message->body ?? "", 0, 20) ?? "";
    }

    function messageByPhone($phone)
    {

        $messages = Message::where('chatId', $phone)->get();
        $result = [];
        foreach ($messages as $c) {
            $result[] = array(
                "date" => Carbon::parse($c->created_at)->format('Y-m-d'),
                "isRight" => $c->from == $c->contact->contactId ? false : true,
                "sender" => !$c->fromMe ? $c->contact->name : "Me",
                "phone" => $c->phone,
                "text" => $c->body ?? "",
                "media" => isset($c->attachmentType) ? array(
                    "mimetype" => $c->attachmentType,
                    "url" => $c->attachmentLink
                ) : NULL,
                "time" => Carbon::parse($c->created_at)->format('H:i')
            );
        }


        return response()->json($result);
    }

    function sendMessage(Request $request)
    {
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


 // function storeOld(Request $request) {
        
    //     try {
    //         if(isset($request->file)){
    //             $mimeToExtension = [
    //                 'image/jpeg' => 'jpg',
    //                 'image/png' => 'png',
    //                 'image/gif' => 'gif',
    //                 'video/mp4' => 'mp4',
    //                 'audio/ogg; codecs=opus' => 'ogg',
    //                 'image/webp' => 'webp'
    //                 // Add more MIME types as needed
    //             ];
                
    //             // Get the file extension based on the MIME type
    //             $extension = isset($mimeToExtension[$request->mimetype]) ? $mimeToExtension[$request->mimetype] : null;

    //             $decodedData = base64_decode($request->file);
    //             // Determine the storage directory
    //             $storagePath = storage_path('app/public/attachment/'); // Change this to your desired storage path
    //             // Generate a random filename
    //             $randomFilename = now()->timestamp.'_'.Str::random(5)."." . $extension; // Adjust the length and file extension as needed

    //             // Save the decoded data to a file
    //             file_put_contents($storagePath . $randomFilename, $decodedData);


    //            $message =  Message::create([
    //                 'phone' => $request->phone,
    //                 'name'  => $request->name,
    //                 'type' => $request->type,
    //                 'body'  => $request->body,
    //                 'attachment_type' => $request->mimetype,
    //                 'attachment_link' => "attachment/".$randomFilename,
    //             ]);
    //         }else{
    //             $message =  Message::create([
    //                 'phone' => $request->phone,
    //                 'name'  => $request->name,
    //                 'type' => $request->type,
    //                 'body'  => $request->body,
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'success',
    //             'data' => $message
    //         ]);
           
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Error '.$th->getMessage(),
    //         ]);
    //     }
    // }