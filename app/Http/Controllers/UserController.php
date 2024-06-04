<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user = User::where('users.id', $user->id)
                    ->leftJoin('contacts', 'users.contact_id', '=', 'contacts.id') // Use leftJoin instead of join
                    ->select('users.*', 'contacts.street as street_name', 'contacts.housenumber as house_number', 'contacts.zipcode as zip_code', 'contacts.city')
                    ->first();

        $noAddressDetails = is_null($user->contact_id);

        return view('user.show', compact('user', 'noAddressDetails'));
    }


    public function edit(User $user)
    {
        $user = User::where('users.id', $user->id)
                    ->join('contacts', 'users.contact_id', '=', 'contacts.id')
                    ->select('users.*', 'contacts.street as street_name', 'contacts.housenumber as house_number', 'contacts.zipcode as zip_code', 'contacts.city')
                    ->first();

        return view('user.edit', compact('user'));
    }

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'contact_person' => 'required|max:255',
        'number' => 'required|unique:users,number,'.$user->id,
        'mobile' => 'required|digits:10|unique:users,mobile,'.$user->id,
        'street_name' => 'required|max:255',
        'house_number' => 'required|numeric',
        'zip_code' => 'required|numeric',
        'city' => 'required|max:255',
    ]);

    try {
        $user->update($request->only('name', 'contact_person', 'number', 'mobile'));

        $contactData = $request->only('street_name', 'house_number', 'zip_code', 'city');
        $user->contact()->update([
            'street' => $contactData['street_name'],
            'housenumber' => $contactData['house_number'],
            'zipcode' => $contactData['zip_code'],
            'city' => $contactData['city'],
        ]);

        return redirect()->route('user.show', $user->id)
            ->with('success', 'User updated successfully');
    } catch (\Exception $e) {
        // Validation error occurred, redirect back with old input
        return redirect()->back()->withInput();
    }
}

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }

}
