<?php

namespace App\Services;

use GuzzleHttp\Client;

class MultimediaMessageService
{
    public $data,$config,$receiver;

    public function __construct($data)
    {
        $this->data=$data;
        $this->config=new WebhookConfigService();
        $this->receiver=new WebhookReceiverService();
    }

    public function handleImage()
    {

        $mediaId = $this->data['entry'][0]['changes'][0]['value']['messages'][0]['image']['id'];
        $url = $this->retrieveMediaUrl($mediaId);
    }


    public function send($message)
    {

    }

    public function handle()
    {

    }

    public function retrieveMediaUrl($id)
    {


        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->config->getToken()
        ];

        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://graph.facebook.com/v14.0/'.$id, $headers,'');
        $res = $client->sendAsync($request)->wait();
        $mediaArray=json_decode($res->getBody(),true);
        return $mediaArray['url'];


    }

    public function downloadMedia($url,$name,$extension)
    {


        $client = new Client();
        if(!(file_exists('downloads/'))){
            mkdir('downloads/',0755, true);
        }

        $resource = fopen('downloads/'.$name.$extension, 'w');

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->webhookToken(),
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/jpeg'
            ],
            'sink' => $resource,
        ]);
        fclose($resource);

    }
}
