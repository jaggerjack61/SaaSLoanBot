<?php

namespace App\Services;

class MultimediaMessageService
{
    public $data,$config;

    public function __construct($data)
    {
        $this->data=$data;
        $this->config=new WebhookConfigService();
    }

    public function send($message)
    {

    }

    public function handle()
    {

    }
}
