<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'email' => 'pelanggan@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        Customer::create([
            'user_id' => $user->id,
            'name' => 'Budi Pelanggan',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 123',
        ]);
    }
}
