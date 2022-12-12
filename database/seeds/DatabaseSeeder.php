<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        foreach (range(1, 200) as $user) {
            $name = \Illuminate\Support\Str::random(4);

            \App\User::create([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => Hash::make($name),
            ]);

            \App\Test::create([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'address' => null,
                'status' => 1
            ]);


        }




    }
}
