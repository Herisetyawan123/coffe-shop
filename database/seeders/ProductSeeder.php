<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $image = $faker->image('public/img/products', 640, 480, null, false);

        Product::create([
            'name' => 'Capucino',
            'description' => 'Kopi enak sekali',
            'category_id' => 1,
            'thumbnail' => url("/img/products/{$image}"),
            'price' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Product::create([
            'name' => 'Arabika',
            'description' => 'Kopi enak sekali',
            'category_id' => 1,
            'thumbnail' => url("/img/products/{$image}"),
            'price' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Product::create([
            'name' => 'Robusta',
            'description' => 'Kopi enak sekali',
            'category_id' => 1,
            'thumbnail' => url("/img/products/{$image}"),
            'price' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
