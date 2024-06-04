<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class AllergyController extends Controller
{
    // index
    public function index($id)
    {
        $product = Product::findOrFail($id);

        $allergies = DB::table('allergies')
            ->join('product_allergies', 'allergies.id', '=', 'product_allergies.allergy_id')
            ->where('product_allergies.product_id', $id)
            ->select('allergies.*')
            ->get();

        return view('allergy.index', ['product' => $product, 'allergies' => $allergies]);
    }
}
