<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\LoanHistory;

class ButtonMessageService
{
    public $data,$config,$receiver,$text;

    public function __construct($data)
    {
        $this->data=$data;
        $this->config=new WebhookConfigService();
        $this->receiver=new WebhookReceiverService();
        $this->text=new TextMessageService($data);
    }

    public function send($message,$buttons)
    {
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->config->getToken()
        ];
        $buttonJson='';
        foreach($buttons as $button) {
            $buttonJson .= '{
                          "type": "reply",
                          "reply": {
                            "id": "'.$button['id'].'",
                            "title": "'.$button['title'].'"
                          }
                        },';
        }

        $body = '{
                  "recipient_type": "individual",
                  "messaging_product": "whatsapp",
                  "to": "'.$this->receiver->getNumber($this->data).'",
                  "type": "interactive",
                  "interactive": {
                    "type": "button",
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
                    "action": {
                      "buttons": [
                        '.$buttonJson.'
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
        $message=$this->data['entry'][0]['changes'][0]['value']['messages'][0]['interactive']['button_reply']['id'];
        return $message;
    }

    public function handle()
    {
        $response=$this->getMessage();
        $list = new ListMessageService($this->data);
        $customer=Customer::where('phone_no',$this->receiver->getNumber($this->data))->first();
        if($response=='apply'){
            if($customer->status=='guest'){
                $customer->message_status='register_name';
                $customer->save();
                $this->send([$this->config->getCompany(),'Please enter your full name.','Registration'],[
                    ['id'=>'cancel','title'=>'Cancel']]
                );
            }
            elseif($customer->status=='registered'){
                $loan=LoanHistory::where('customer_id',$customer->id)->latest()->first();
                if($loan->status=='in-progress'){
                    $this->text->send('You have not finished paying back your loan of $'.$loan->amount.' '.$loan->currency.'.');
                }
                elseif($loan->status=='defaulted'){
                    $this->text->send('You have defaulted a loan before. You are no longer qualified to apply for loans.');
                }
                else{

                    $this->send([$this->config->getCompany(),'Please select the loan currency.','Loan Application'],[
                        ['id'=>'usd','title'=>'USD'],
                        ['id'=>'rtgs','title'=>'RTGS/ZWL'],
                        ['id'=>'cancel','title'=>'Cancel']
                    ]);

                }
            }
            elseif($customer->status=='pending'){
                $loan=LoanHistory::where('customer_id',$customer->id)->latest()->first();
                if($loan){
                    if($loan->status=='pending') {
                        $this->text->send('You cannot apply for a new loan you already have a loan pending approval');
                    }
                    else{
                        $this->send([$this->config->getCompany(), 'Please select the loan currency.', 'Loan Application'], [
                            ['id' => 'usd', 'title' => 'USD'],
                            ['id' => 'rtgs', 'title' => 'RTGS/ZWL'],
                            ['id' => 'cancel', 'title' => 'Cancel']
                        ]);
                    }
                }
                else{
                    $this->send([$this->config->getCompany(), 'Please select the loan currency.', 'Loan Application'], [
                        ['id' => 'usd', 'title' => 'USD'],
                        ['id' => 'rtgs', 'title' => 'RTGS/ZWL'],
                        ['id' => 'cancel', 'title' => 'Cancel']
                    ]);
                }
            }
        }

        elseif($response=='cancel'){
            $customer->message_status='none';
            $customer->save();
            $this->text->send('Have a nice day');
        }

        elseif($response=='usd'){
            LoanHistory::create([
                'customer_id'=>$customer->id,
                'currency'=>'USD'
            ]);
            $customer->message_status='loan_amount';
            $customer->save();
            $this->send([$this->config->getCompany(),'Please enter the amount you want to borrow as a number eg 5000 .','Loan Application'],[
                ['id'=>'cancel','title'=>'Cancel']
            ]);
        }
        elseif($response=='rtgs'){
            LoanHistory::create([
                'customer_id'=>$customer->id,
            ]);
            $customer->message_status='loan_amount';
            $customer->save();
            $this->send([$this->config->getCompany(),'Please enter the amount you want to borrow as a number eg 5000 .','Loan Application'],[
                ['id'=>'cancel','title'=>'Cancel']
            ]);
        }
        elseif($response=='faq'){
            $list->send([$this->config->getCompany(),'Welcome to our list of frequently asked questions. Click the view button below to see the questions.','FAQs','View Question'],
                [
                    ['id'=>'q1','title'=>'Question 1','description'=>'I dont want to pay back my loan, do you guys break knee caps?'],
                    ['id'=>'q2','title'=>'Question 2','description'=>'How long can I take to pay back a loan?'],
                    ['id'=>'q3','title'=>'Question 3','description'=>'How long does loan approval usually take?'],
                    ['id'=>'q4','title'=>'Question 4','description'=>'Where can i find your offices?'],
                    ['id'=>'q5','title'=>'Question 5','description'=>'Who made this chatbot?']
                ]

            );
        }
        elseif($response=='help'){
            $this->text->send('You can call us on 0777777777 to talk to one of our attendants. Have a nice day.');
        }

    }
}
