<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Menu;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan ada customer dan menu
        $customers = Customer::pluck('id')->toArray();
        $menus = Menu::pluck('id')->toArray();

        if (empty($customers) || empty($menus)) {
            $this->command->error('Seeder gagal: Tambahkan data di tabel customers dan menus dulu.');
            return;
        }

        // Buat 10 order dummy
        for ($i = 1; $i <= 10; $i++) {
            $order = Order::create([
                'customer_id' => $customers[array_rand($customers)],
                'order_date' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
                'delivery_date' => Carbon::now()->addDays(rand(1, 7))->format('Y-m-d'),
                'status' => ['pending', 'completed', 'cancelled'][rand(0, 2)],
            ]);

            // Tambahkan 1-5 item per order
            for ($j = 0; $j < rand(1, 5); $j++) {
                $menu_id = $menus[array_rand($menus)];
                $quantity = rand(1, 3);
                $price = rand(10000, 50000);

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu_id,
                    'quantity' => $quantity,
                    'subtotal' => $quantity * $price,
                ]);
            }
        }

        $this->command->info('Dummy orders dan order_items berhasil dibuat.');
    }
}
