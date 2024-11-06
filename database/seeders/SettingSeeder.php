<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::updateOrCreate(['id' => 1],['logo' => 'logo-remove-bg.png','favicon' => 'logo-remove-bg.png']);
    }
}
