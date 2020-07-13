<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function sendSmsTwilio($to, $from, $msg)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);

        try{
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                $to,
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => $from,
                 // the body of the text message you'd like to send
                 'body' => $msg
             )
         );
        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function sendSmsNexmo($to, $from, $msg)
    {
        Nexmo::message()->send([
            'to' => $to,
            'from' => $from,
            'text' => $msg
        ]);
    }
}