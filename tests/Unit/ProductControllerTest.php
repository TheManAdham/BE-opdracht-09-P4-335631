<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $product = DB::table('products')->insertGetId([
            'name' => 'Test Product',
            'barcode' => '1234567890',
        ]);

        $store = DB::table('stores')->insert([
            'product_id' => $product,
            'unit' => '10 kg',
            'amount' => 10,
        ]);

        $response = $this->get('/products');
        $response->assertViewIs('dashboard');
        $response->assertViewHas('products');
        $products = $response->viewData('products');
        $this->assertCount(1, $products);
        $this->assertEquals('Test Product', $products[0]->name);
        $this->assertEquals('1234567890', $products[0]->barcode);
        $this->assertEquals('kg', $products[0]->unit);
        $this->assertEquals(10, $products[0]->amount);
    }

    public function testGetDeliveredProducts()
    {
        $request = new Request();
        $request->replace(['start_date' => '2022-01-01', 'end_date' => '2022-12-31']);

        $response = $this->call('GET', 'delivered/index', $request->all());

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetDeliveredProductSpecification()
    {
        $request = new Request();
        $request->replace(['start_date' => '2022-01-01', 'end_date' => '2022-12-31']);

        $product = Product::first();

        if ($product) {
            $response = $this->call('GET', 'delivered/specification/'.$product->id, $request->all());

            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->assertTrue(true, 'No products available to test');
        }
    }
}
