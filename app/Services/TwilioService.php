<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    public static function sendMessage($recipientPhone, $message)
    {
        $twilioAccountSid = 'AC53c3ad7483fdcad468ac8ccee7748015';
        $twilioAuthToken = '76694f48d1eb3ee9007c9712777a8648';
        $twilioWhatsAppNumber = '+14155238886';


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
