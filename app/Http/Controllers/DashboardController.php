<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChartResource;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function chart()
    {
        Gate::authorize('view', 'orders');

        $orders = Order::query()
            ->join('order_items', 'order_id', '=', 'order_items.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity*order_items.price) as sum")
            ->groupBy('date')
            ->get();

        return ChartResource::collection($orders);
    }
}
