<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\LoanHistory;

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
        $list = new ListMessageService($this->data);
        $customer=Customer::where('phone_no',$this->receiver->getNumber($this->data))->first();
        if($this->getMessage()){
            if($customer->message_status=='none'){
                $button->send([$this->config->getCompany(),'Hie '.$customer->name.' welcome to our whatsapp chatbot for loan applications. Please select any of the options below to proceed.','Get Started'],[
                    ['id'=>'apply','title'=>'Apply for loan'],
                    ['id'=>'help','title'=>'Get Help'],
                    ['id'=>'faq','title'=>'FAQ']]);
            }
            elseif($customer->message_status=='register_name'){
                $customer->name=$this->getMessage();
                $customer->message_status='register_ec';
                $customer->save();
                $button->send([$this->config->getCompany(),'Please enter your EC number.','Registration'],[
                        ['id'=>'cancel','title'=>'Cancel']]
                );
            }
            elseif($customer->message_status=='register_ec'){
                $customer->EC=$this->getMessage();
                $customer->message_status='register_id';
                $customer->save();
                $button->send([$this->config->getCompany(),'Please send a picture of your ID card or passport.','Registration'],[
                        ['id'=>'cancel','title'=>'Cancel']]
                );
            }
            elseif($customer->message_status=='register_bank'){
                $customer->bank=$this->getMessage();
                $customer->message_status='register_account';
                $customer->save();
                $button->send([$this->config->getCompany(),'Please enter your bank account number.','Registration'],[
                        ['id'=>'cancel','title'=>'Cancel']]
                );
            }
            elseif($customer->message_status=='register_account'){
                $customer->account_number=$this->getMessage();
                $customer->status='pending';
                $customer->message_status='none';
                $customer->save();
                $button->send([$this->config->getCompany(),'Please select the loan currency.','Loan Application'],[
                    ['id'=>'usd','title'=>'USD'],
                    ['id'=>'rtgs','title'=>'RTGS/ZWL'],
                    ['id'=>'cancel','title'=>'Cancel']
                ]);
            }

            elseif($customer->message_status=='loan_amount'){
                $loan = LoanHistory::where('customer_id',$customer->id)
                    ->where('status','in-progress')
                    ->latest()
                    ->first();
                $loan->amount=$this->getMessage();
                $loan->save();
                $customer->message_status='loan_duration';
                $customer->save();
                $this->sendPeriods($list);

            }

            elseif($customer->message_status=='loan_amount'){
                $this->sendPeriods($list);

            }

            else{
                $this->send('Nada');
            }


        }
    }

    /**
     * @param ListMessageService $list
     * @return void
     */
    public function sendPeriods(ListMessageService $list): void
    {
        $list->send(
            [$this->config->getCompany(), 'Please select the loan pay back period from the list below', 'Loan Application','View Periods'],
            [
                ['id' => '1m', 'title' => '1 Month', 'description' => '30 day period'],
                ['id' => '2m', 'title' => '2 Months', 'description' => '60 day period'],
                ['id' => '3m', 'title' => '3 Months', 'description' => '90 day period'],
                ['id' => '4m', 'title' => '4 Months', 'description' => '120 day period'],
                ['id' => '5m', 'title' => '5 Months', 'description' => '150 day period'],
                ['id' => '6m', 'title' => '6 Months', 'description' => '180 day period']

            ]);
    }
}
