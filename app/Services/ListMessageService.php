<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\LoanHistory;
use GuzzleHttp\Client;

class ListMessageService
{
    public $data,$config,$receiver;

    public function __construct($data)
    {
        $this->data=$data;
        $this->config=new WebhookConfigService();
        $this->receiver=new WebhookReceiverService();
    }

    public function send($message,$list)

    {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->config->getToken()
        ];

        $listJson='';
        foreach($list as $item) {
            $listJson .= '{
                            "id": "'.$item['id'].'",
                            "title": "'.$item['title'].'",
                            "description": "'.$item['description'].'"
                          },';
        }

        $body = '{
                  "recipient_type": "individual",
                  "messaging_product": "whatsapp",
                  "to": "'.$this->receiver->getNumber($this->data).'",
                  "type": "interactive",
                  "interactive": {
                    "type": "list",
                    "header": {
                      "type": "text",
                      "text": "'.$message[0].'"
                    },
                    "body": {
                      "text": "'.$message[1].'"
                    },
                    "footer": {
                      "text": "'.$message[2].'"
                    },
                    "action":{
                      "button": "'.$message[3].'",
                      "sections":[
                        {

                          "rows": [
                            '.$listJson.'
                          ]
                        }
                      ]
                  }
                }
              }';
        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://graph.facebook.com/v14.0/'.$this->config->getPhoneId().'/messages', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }


    public function getMessage()
    {
        $message=$this->data['entry'][0]['changes'][0]['value']['messages'][0]['interactive']['list_reply']['id'];
        return $message;
    }



    public function handle()
    {
        $customer=Customer::where('phone_no',$this->receiver->getNumber($this->data))->first();
        $text = new TextMessageService($this->data);
        $response = $this->getMessage();
        if($response=='1m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='1 month';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }
        elseif($response=='2m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='2 months';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }
        elseif($response=='3m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='3 months';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }
        elseif($response=='4m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='4 months';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }
        elseif($response=='5m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='5 months';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }
        elseif($response=='6m'){
            $customer->message_status='none';
            $loan=LoanHistory::where('customer_id',$customer->id)
                ->where('status','in-progress')
                ->latest()
                ->first();
            $loan->due_date='6 months';
            $loan->status='pending';
            $loan->save();
            $text->send('Your loan application is pending approval.');
        }

        elseif($response=='q1'){
            $text->send('Yes we do break knee caps you better have our money or else.');
        }
        elseif($response=='q2'){
            $text->send('You can take up to 6 months to pay back your loan.');
        }
        elseif($response=='q3'){
            $text->send('Approval usually takes between 3 to 5 business days.');
        }
        elseif($response=='q4'){
            $text->send('*Harare Branch* 123 Road Name , Banana Building Room A4, Milton Park ,Harare');
            $text->send('*Buluwayo Branch* 123 Street Name , Buluwayo Town Here ,Buluwayo');
            $text->send('*Victoria Falls Branch* 123 Avenue Name , Vic Falls Town Here ,Buluwayo');
        }
        elseif($response=='q5'){
            $text->send('Software company name made this bot. Contact us on phone number');
        }

        $customer->save();
    }
}
