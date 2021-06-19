<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChartResource;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function chart()
    {
        Gate::authorize('view', 'orders');

		/*
        $orders = Order::query()
            ->join('order_items', 'order_id', '=', 'order_items.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity*order_items.price) as sum")
            ->groupBy('date')
            ->get();
		*/
		
		$orders = DB::select(
            DB::raw("SELECT DATE_FORMAT(a.created_at, '%Y-%m-%d') as date, 	
					sum(b.quantity*b.price) as sum
					FROM orders a, order_items b
					WHERE a.id = b.order_id GROUP BY a.created_at;")
			);

        return ChartResource::collection($orders);
    }
}
