<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
        ->join('stores', 'products.id', '=', 'stores.product_id')
        ->select('products.*', 'stores.unit', 'stores.amount')
        ->orderBy('products.barcode', 'asc')
        ->get();

        return view('dashboard', ['products' => $products]);
    }

    public function getProductAlergies(Request $request)
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

    public function getDeliveredProducts(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('product_users')
            ->join('products', 'product_users.product_id', '=', 'products.id')
            ->join('users', 'product_users.user_id', '=', 'users.id')
            ->join('contacts', 'users.contact_id', '=', 'contacts.id')
            ->select('product_id','users.name as user_name', 'users.contact_person', 'products.name as product_name', DB::raw('SUM(product_users.amount) as total_amount'), 'products.barcode as specification')
            ->groupBy('users.name', 'users.contact_person', 'products.name', 'products.barcode')
            ->orderBy('users.name', 'ASC');

        if ($startDate && $endDate) {
            $query->whereBetween('product_users.datedelivery', [$startDate, $endDate]);
        }

        $products = $query->get();

        return view('delivered.index', ['products' => $products, 'startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function getDeliveredProductSpecification($productId, Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $product = Product::find($productId);

        $allergies = DB::table('product_allergies')
        ->where('product_allergies.product_id', '=', $productId)
        ->join('allergies', 'product_allergies.allergy_id', '=', 'allergies.id')
        ->select('allergies.name')
        ->get();

        $query = DB::table('product_users')
            ->where('product_users.product_id', '=', $productId)
            ->select('product_users.datedelivery', 'product_users.amount');

        if ($startDate && $endDate) {
            $query->whereBetween('product_users.datedelivery', [$startDate, $endDate]);
        }

        $deliveries = $query->get();

        return view('delivered.specification', [
            'product' => $product,
            'deliveries' => $deliveries,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'allergies' => $allergies,
        ]);
    }

}
