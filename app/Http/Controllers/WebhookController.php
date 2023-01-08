<?php

namespace App\Http\Controllers;

use App\Services\WebhookConfigService;
use App\Services\WebhookReceiverService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function setup(Request $request){
        $mode=$request->hub_mode;
        $token=$request->hub_verify_token;
        $challenge=$request->hub_challenge;
        if($mode and $token){
            return response ($challenge, 200);
        }
        return response('',404);
    }

    public function receiver(WebhookReceiverService $receiver, Request $request)
    {
        $receiver->receive($request);
    }
}
