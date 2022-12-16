<?php

namespace App\Services;

class TextMessageService
{
    public $data,$config,$receiver;

    public function __construct($data)
    {
        $this->data=$data;
        $this->config=new WebhookConfigService();
        $this->receiver=new WebhookReceiverService();
    }

    public function send($message)
    {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->config->getToken()
        ];
        $body = '{
                "messaging_product": "whatsapp",
                "preview_url": false,
                "recipient_type": "individual",
                "to": "'.$this->receiver->getNumber($this->data).'",
                "type": "text",
                "text": {
                    "body": "'. $message .'"
                }
            }';

        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://graph.facebook.com/v13.0/'.$this->config->getPhoneId().'/messages', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

    }

    public function getMessage()
    {
        $message=$this->data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
        return $message;
    }

    public function handle()
    {

    }
}
