<?php


namespace App\Services;

use App\Models\Customer;
use App\Models\WhatsappMessage;
use Illuminate\Http\Request;

class WebhookReceiverService
{
    public $phone;

    public function receiver(Request $request)
    {
        $data = $request->all();

        if(array_key_exists('messages',$data['entry'][0]['changes'][0]['value'])){

            if(array_key_exists('text',$data['entry'][0]['changes'][0]['value']['messages'][0])){
                $textService = new TextMessageService($data);
                $textService->handle();

            }
            elseif(array_key_exists('interactive',$data['entry'][0]['changes'][0]['value']['messages'][0])) {
                if (array_key_exists('button_reply', $data['entry'][0]['changes'][0]['value']['messages'][0]['interactive'])) {
                    $this->handleResponse($data);

                }
                elseif(array_key_exists('list_reply', $data['entry'][0]['changes'][0]['value']['messages'][0]['interactive'])) {
                    $this->handleList($data);

                }
            }
            elseif(array_key_exists('image',$data['entry'][0]['changes'][0]['value']['messages'][0])) {
                $this->handleImage($data);

            }

        }
        elseif(array_key_exists('statuses',$data['entry'][0]['changes'][0]['value']))
        {
            $this->handleStatus($data);
        }



        return response('',200);
    }

    public function checkCustomer($data)
    {
        $phoneNo=$this->getNumber($data);
        $customer=Customer::where('phone_no',$phoneNo)->first();
        if(!$customer){
            Customer::create([
                'phone_no' => $this->phone
            ]);
        }
    }

    public function getNumber($data){
        return $data['entry'][0]['changes'][0]['value']['messages'][0]['from'] ?? 'no number';
    }


}
