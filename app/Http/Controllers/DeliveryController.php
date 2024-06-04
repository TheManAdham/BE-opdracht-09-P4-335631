<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class DeliveryController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        $deliveries = DB::table('product_users')
            ->join('users', 'product_users.user_id', '=', 'users.id')
            ->join('products', 'product_users.product_id', '=', 'products.id')
            ->join('stores', 'products.id', '=', 'stores.product_id')
            ->where('product_users.user_id', $id)
            ->select('product_users.*', 'users.name as user_name', 'users.contact_person', 'users.number', 'users.mobile', 'products.name as product_name', 'stores.amount as store_amount')
            ->orderBy('product_users.datedelivery', 'asc')
            ->get();

        return view('delivery.index', ['user' => $user, 'deliveries' => $deliveries]);
    }
}
