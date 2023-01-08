<?php

namespace App\Services;

use App\Models\Customer;

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
        $button=new ButtonMessageService($this->data);
        $customer=Customer::where('phone_no',$this->receiver->getNumber($this->data))->first();
        if($this->getMessage()){
            if($customer->status=='none'){
                $button->send([$this->config->getBusiness(),'','Get Started'],[
                    ['id'=>'apply','title'=>'Apply for loan'],
                    ['id'=>'help','title'=>'Get Help'],
                    ['id'=>'faq','title'=>'FAQ']]);
            }
            elseif($customer->status=='name'){
                $customer->name=$this->getMessage();
                $customer->save();
            }
            elseif($customer->status=='ID'){
                $customer->ID=$this->getMessage();
                $customer->save();
            }
            elseif($customer->status=='bank'){
                $customer->bank=$this->getMessage();
                $customer->save();
            }
            elseif($customer->status=='EC'){
                $customer->EC=$this->getMessage();
                $customer->save();
            }
            elseif($customer->status=='account_no'){
                $customer->account_no=$this->getMessage();
                $customer->save();
            }


        }
    }
}
