<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Link;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $users = User::all();
        foreach(range(1, 2) as $index) {
            DB::table('links')->insert([
                'code' => Str::random(10),
                'user_id' => $users->get($index - 1)->id
            ]);
        }

        foreach(range(1,4) as $index) {
            DB::table('products')->insert([
                'name' => Str::random(10),
                'price' => fake()->randomFloat(2)
            ]);
        }
        $links = Link::all();
        $products = Product::all();
        foreach ($products as $index => $product) {
            DB::table('link_product')->insert([
                'link_id' => $links->get($index > 1 ? 1 : 0)->id,
                'product_id' => $product->id
            ]);
        }
    }
}
