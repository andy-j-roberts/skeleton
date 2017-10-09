<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Setting::class)->create([
            'namespace' => 'app',
            'key' => 'name',
            'value' => 'Engine',
            'type' => 'string',
            'display_name' => 'App name',
            'description' => 'Name of the application'
        ]);
        factory(\App\Setting::class, 20)->create();
    }
}
