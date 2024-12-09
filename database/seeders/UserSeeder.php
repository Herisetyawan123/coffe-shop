<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $image = $faker->image('public/img/profile', 640, 480, null, false);

        $admin = User::create([
            'name' => 'Admin PT Coffe Shop',
            'email' => 'admin@mail.com',
            'address' => 'Jl. Teuku Umar Gg Pasir No.35 Jember',
            'phone' => '+62 88888888',
            'job_position' => "CEO PT Coffe Shop",
            "born_date" => now(),
            'photo' => url("/img/profile/{$image}"),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($admin));
        // $admin->assignRole('admin');
    }
}
