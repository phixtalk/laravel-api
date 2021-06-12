<?php

use App\Order;
use App\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 30)->create()
            ->each(function (Order $order) {
                factory(OrderItem::class, random_int(1, 5))->create([
                    'order_id' => $order->id
                ]);
            });
    }
}
