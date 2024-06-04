<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $contact = DB::table('contacts')->insertGetId([
            'street' => 'Test Street',
            'housenumber' => '123',
            'zipcode' => '12345',
            'city' => 'Test City',
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'contact_id' => $contact,
            'number' => '1234567890',
            'mobile' => '0987654321',
        ]);

        // show metodunu çağırın
        $response = $this->get('/user/' . $user->id);

        $response->assertViewIs('user.show');
        $response->assertViewHas('user');
        $userInView = $response->viewData('user');
        $this->assertEquals('Test User', $userInView->name);
        $this->assertEquals('Test Street', $userInView->street_name);
        $this->assertEquals('123', $userInView->house_number);
        $this->assertEquals('12345', $userInView->zip_code);
        $this->assertEquals('Test City', $userInView->city);
    }
}
