<?php


namespace App\Services;

use App\Models\Customer;
use App\Models\WhatsappMessage;
use Illuminate\Http\Request;

class WebhookReceiverService
{
    public $phone;

    public function receive($request)
    {
        $data = $request->all();


        if(array_key_exists('messages',$data['entry'][0]['changes'][0]['value'])){

            if(array_key_exists('text',$data['entry'][0]['changes'][0]['value']['messages'][0])){
                $this->checkCustomer($data);
                $textService = new TextMessageService($data);
                $textService->handle();


            }
            elseif(array_key_exists('interactive',$data['entry'][0]['changes'][0]['value']['messages'][0])) {
                if (array_key_exists('button_reply', $data['entry'][0]['changes'][0]['value']['messages'][0]['interactive'])) {
                    $button = new ButtonMessageService($data);
                    $button->handle();

                }
                elseif(array_key_exists('list_reply', $data['entry'][0]['changes'][0]['value']['messages'][0]['interactive'])) {
                    $list = new ListMessageService($data);
                    $list->handle();


                }
            }
            elseif(array_key_exists('image',$data['entry'][0]['changes'][0]['value']['messages'][0])) {
                $media = new MultimediaMessageService($data);
                $media->handle();

            }

        }




        return response('',200);
    }

    public function checkCustomer($data)
    {
        $phoneNo=$this->getNumber($data);
        $customer=Customer::where('phone_no',$phoneNo)->first();
        if(!$customer){
            Customer::create([
                'phone_no' => $phoneNo,
                'name'=>$data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name']
            ]);
        }
    }

    public function getNumber($data){
        return $data['entry'][0]['changes'][0]['value']['messages'][0]['from'] ?? 'no number';
    }


}
