<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Advisor',
                'email' => 'advisor@gmail.com',
                'level' => 'advisor',
                'password' => bcrypt('advisor')
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
