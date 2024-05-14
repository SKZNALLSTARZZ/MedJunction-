<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    public static function sendMessage($recipientPhone, $message)
    {


        $client = new Client($twilioAccountSid, $twilioAuthToken);

        $client->messages->create(
            "whatsapp:$recipientPhone",
            [
                "from" => "whatsapp:$twilioWhatsAppNumber",
                "body" => $message
            ]
        );
    }
}
