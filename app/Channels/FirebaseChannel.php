<?php

namespace App\Channels;

use App\Models\FcmToken;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Google\Auth\Credentials\ServiceAccountCredentials;

class FirebaseChannel
{
    public function send($notifiable, Notification $notification)
    {
        // dd("d,sld,lsdlsdlsd");
        $credential = new ServiceAccountCredentials(
            "https://www.googleapis.com/auth/firebase.messaging",
            json_decode(file_get_contents("/var/www/dookops-firebase-adminsdk-f0nq3-71b6480213.json"), true)
        );
        $accessToken = $credential->fetchAuthToken(HttpHandlerFactory::build());
        // dd($accessToken);
        $message = $notification->toFirebase($notifiable);
        $tokens = FcmToken::where('user_id',$notifiable->id)->get();
        if($tokens->count() >0):
            foreach($tokens as $token):
                $client = new Client();
                $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken['access_token']
                ];
                $body = [
                'message'=>[
                        'token'=>$token->fcm_tokens,
                        "notification"=>[
                            "title"=> $message['title'],
                            "body"=>  $message['body'],
                        ],
                        'webpush'=>[
                            'fcm_options'=>[
                                'link'=>'https://google.com',
                            ]
                        ]
                    ]
                ];
                // dd(json_encode($body));
                $request = new Request('POST', 'https://fcm.googleapis.com/v1/projects/dookops/messages:send', $headers, json_encode($body));
                $res = $client->sendAsync($request)->wait();
            endforeach;
        return true;
        endif;
        
        // return false;
    }
}