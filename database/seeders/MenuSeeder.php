<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            // 🥡 Nasi Kotak
            [
                'name' => 'Nasi Kotak Ayam Bakar',
                'description' => 'Nasi, ayam bakar, sambal, lalapan, kerupuk.',
                'price' => 25000,
                'category_id' => 1,
                'created_by' => 1,
            ],
            [
                'name' => 'Nasi Kotak Rendang',
                'description' => 'Nasi putih dengan rendang sapi, sambal ijo dan sayur.',
                'price' => 28000,
                'category_id' => 1,
                'created_by' => 1,
            ],

            // 🥗 Diet Sehat
            [
                'name' => 'Chicken Salad',
                'description' => 'Dada ayam panggang dengan sayur segar dan dressing lemon.',
                'price' => 30000,
                'category_id' => 2,
                'created_by' => 1,
            ],
            [
                'name' => 'Oatmeal Buah',
                'description' => 'Oatmeal sehat dengan topping pisang, apel, dan madu.',
                'price' => 22000,
                'category_id' => 2,
                'created_by' => 1,
            ],

            // 🎒 Paket Anak Sekolah
            [
                'name' => 'Nasi Goreng Anak',
                'description' => 'Nasi goreng tidak pedas dengan telur dan nugget.',
                'price' => 18000,
                'category_id' => 3,
                'created_by' => 1,
            ],
            [
                'name' => 'Mie Telur Mini',
                'description' => 'Mie goreng tanpa MSG, telur dadar, dan sayur.',
                'price' => 17000,
                'category_id' => 3,
                'created_by' => 1,
            ],

            // 🍽️ Prasmanan
            [
                'name' => 'Paket Prasmanan A',
                'description' => 'Nasi, ayam goreng, mie goreng, capcay, buah, kerupuk.',
                'price' => 35000,
                'category_id' => 4,
                'created_by' => 1,
            ],
            [
                'name' => 'Paket Prasmanan B',
                'description' => 'Nasi, rendang, sambal goreng kentang, sayur asem, buah.',
                'price' => 40000,
                'category_id' => 4,
                'created_by' => 1,
            ],

            // 🍳 Sarapan
            [
                'name' => 'Bubur Ayam',
                'description' => 'Bubur ayam lengkap dengan cakwe, telur, kerupuk.',
                'price' => 15000,
                'category_id' => 5,
                'created_by' => 1,
            ],
            [
                'name' => 'Lontong Sayur',
                'description' => 'Lontong dengan kuah santan, tahu, telur dan sambal.',
                'price' => 16000,
                'category_id' => 5,
                'created_by' => 1,
            ],

            // 🍩 Snack & Minuman
            [
                'name' => 'Snack Box A',
                'description' => 'Pastel, risol, kue lapis dan teh kotak.',
                'price' => 12000,
                'category_id' => 6,
                'created_by' => 1,
            ],
            [
                'name' => 'Es Buah Segar',
                'description' => 'Minuman dingin isi melon, semangka, sirup dan susu.',
                'price' => 10000,
                'category_id' => 6,
                'created_by' => 1,
            ],

            // 🎉 Spesial Bulanan
            [
                'name' => 'Paket Ramadan',
                'description' => 'Nasi kebuli, ayam bakar, kurma, air mineral.',
                'price' => 35000,
                'category_id' => 7,
                'created_by' => 1,
            ],
            [
                'name' => 'Paket Tahun Baru',
                'description' => 'Sate ayam + lontong, kue kering, teh botol.',
                'price' => 40000,
                'category_id' => 7,
                'created_by' => 1,
            ],
        ]);
    }
}
