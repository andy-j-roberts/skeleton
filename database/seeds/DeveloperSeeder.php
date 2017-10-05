<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Andy Roberts',
            'email' => 'andy.roberts@carpe-diem.co.uk',
            'password' => 'password',
        ]);
        $user->assignRole('admin');
    }
}
