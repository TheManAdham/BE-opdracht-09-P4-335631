<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductWithAllergy extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('product_allergies', 'products.id', '=', 'product_allergies.product_id')
            ->join('allergies', 'product_allergies.allergy_id', '=', 'allergies.id')
            ->join('product_users', 'products.id', '=', 'product_users.product_id')
            ->select('products.*', 'allergies.name as allergy_name', 'allergies.description as allergy_description', 'product_users.amount as amount');

        if ($request->filled('allergy_id')) {
            $query->where('product_allergies.allergy_id', $request->allergy_id);
        }

        $products = $query->get();

        $allergies = DB::table('allergies')->get();

        return view('allergies.index', ['products' => $products, 'allergies' => $allergies]);
    }
}
