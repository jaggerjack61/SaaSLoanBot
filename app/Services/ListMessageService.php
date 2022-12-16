<?php

namespace App\Services;

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



    public function handle()
    {

    }
}
