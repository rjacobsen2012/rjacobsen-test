<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!$user = User::where('name', 'Test User')->first()) {
            User::create([
                'name' => 'Test User',
                'email' => 'testuser@test.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('secret')
            ]);
        }
    }
}
