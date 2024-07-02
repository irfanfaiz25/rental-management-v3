<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV01',
            'model' => 'PS 3',
            'price' => 5000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV02',
            'model' => 'PS 3',
            'price' => 5000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV03',
            'model' => 'PS 3',
            'price' => 5000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV04',
            'model' => 'PS 4',
            'price' => 8000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV05',
            'model' => 'PS 4',
            'price' => 8000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV06',
            'model' => 'PS 4',
            'price' => 8000
        ]);

        DB::table('consoles')->insert([
            'name' => 'TV06',
            'model' => 'PS 4',
            'price' => 8000
        ]);

        DB::table('menus')->insert([
            'name' => 'Es Teh',
            'category' => 'minuman',
            'price' => 3000
        ]);

        DB::table('menus')->insert([
            'name' => 'Es Jeruk',
            'category' => 'minuman',
            'price' => 4000
        ]);

        DB::table('menus')->insert([
            'name' => 'Es Good Day',
            'category' => 'minuman',
            'price' => 4000
        ]);

        DB::table('menus')->insert([
            'name' => 'Es Kopi',
            'category' => 'minuman',
            'price' => 4000
        ]);

        DB::table('menus')->insert([
            'name' => 'Es Susu',
            'category' => 'minuman',
            'price' => 5000
        ]);

        DB::table('menus')->insert([
            'name' => 'Nasi Goreng',
            'category' => 'makanan',
            'price' => 13000
        ]);

        DB::table('menus')->insert([
            'name' => 'Mie Goreng',
            'category' => 'makanan',
            'price' => 10000
        ]);

        DB::table('menus')->insert([
            'name' => 'Mie Rebus',
            'category' => 'makanan',
            'price' => 10000
        ]);
    }
}
