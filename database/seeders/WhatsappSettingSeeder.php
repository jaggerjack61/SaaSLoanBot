<?php

namespace Database\Seeders;

use App\Models\WhatsappSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhatsappSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WhatsappSetting::create([
            'bearer_token'=>'token',
            'whatsapp_id'=>'id',
            'company_name'=>'name'
        ]);
    }
}
