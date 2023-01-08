<?php

namespace App\Services;

use App\Models\Customer;
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
        $customer=Customer::where('phone_no',$this->receiver->getNumber($this->data))->first();
        $mediaId = $this->data['entry'][0]['changes'][0]['value']['messages'][0]['image']['id'];
        $button = new ButtonMessageService($this->data);
        $url = $this->retrieveMediaUrl($mediaId);
        if($customer->message_status == 'register_id'){
            $this->downloadMedia($url,'id');
            $customer->message_status='register_payslip';
            $customer->save();
            $button->send([$this->config->getCompany(),'Please send us a picture of your most recent payslip.','Registration'],[
                    ['id'=>'cancel','title'=>'Cancel']]
            );
        }
        elseif($customer->message_status == 'register_payslip'){
            $this->downloadMedia($url,'payslip');
            $customer->message_status='register_bank';
            $customer->save();
            $button->send([$this->config->getCompany(),'Please enter the name of your bank in full.','Registration'],[
                ['id'=>'cancel','title'=>'Cancel']]
            );
        }
        else{
            $text = new TextMessageService($this->data);
            $text->send('Nice picture media file, but please use the supplied buttons to proceed');
        }
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

    public function downloadMedia($url,$name)
    {


        $client = new Client();
        if(!(file_exists('customers/'))){
            mkdir('customers/',0755, true);
        }
        if(!(file_exists('customers/'.$this->receiver->getNumber($this->data).'/'))){
            mkdir('customers/'.$this->receiver->getNumber($this->data).'/',0755, true);
        }

        $resource = fopen('customers/'.$this->receiver->getNumber($this->data).'/'.$name.'.jpg', 'w');

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->config->getToken(),
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/jpeg'
            ],
            'sink' => $resource,
        ]);
        fclose($resource);

    }
}
