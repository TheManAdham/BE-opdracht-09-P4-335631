<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leverancier Details') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <table class="table-auto border-collapse border-2 border-gray-500">
            <thead>
                <tr>
                    <th class="border-2 border-gray-400 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Contact Person</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Number</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Mobile</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Street</th>
                    <th class="border-2 border-gray-400 px-4 py-2">House Number</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Zip Code</th>
                    <th class="border-2 border-gray-400 px-4 py-2">City</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-2 border-gray-400 px-4 py-2">{{ $user->name }}</td>
                    <td class="border-2 border-gray-400 px-4 py-2">{{ $user->contact_person }}</td>
                    <td class="border-2 border-gray-400 px-4 py-2">{{ $user->number }}</td>
                    <td class="border-2 border-gray-400 px-4 py-2">{{ $user->mobile }}</td>
                    @if($noAddressDetails)
                        <td colspan="4" class="border-2 border-gray-400 px-4 py-2">There are no address details</td>
                    @else
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->street_name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->house_number }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->zip_code }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->city }}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex justify-center mt-6 space-x-4">
        <div>
            <a href="{{ route('user.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
        </div>
        <div>
            <a href="{{ route('user.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                Back
            </a>
            <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Home
            </a>
        </div>
    </div>
</x-app-layout>
