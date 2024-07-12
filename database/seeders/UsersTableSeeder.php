<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Yoan Fauzia',
            'username' => 'yoan',
            'password' => Hash::make('yoanadmin123')
        ]);
        $superAdmin->assignRole('super admin');

        $admin = User::create([
            'name' => 'Operator',
            'username' => 'ggwp',
            'password' => Hash::make('ggwpoperator123')
        ]);
        $admin->assignRole('admin');
    }
}
