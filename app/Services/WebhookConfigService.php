<?php

namespace App\Services;

use App\Models\WhatsappSetting;
use Illuminate\Http\Request;

class WebhookConfigService
{
    public function verify(Request $request)
    {
        $mode=$request->hub_mode;
        $token=$request->hub_verify_token;
        $challenge=$request->hub_challenge;
        if($mode and $token){
            return response ($challenge, 200);
        }
        return response('',404);
    }

    public function getToken()
    {
        $settings=WhatsappSetting::first();
        return $settings->bearer_token;
    }

    public function getPhoneId()
    {
        $settings=WhatsappSetting::first();
        return $settings->phone_id;
    }





    public function getBusiness()
    {
        $settings=WhatsappSetting::first();
        return $settings->business_name;
    }
}

