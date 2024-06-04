<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Leveranciers') }}
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
                    <th class="border-2 border-gray-400 px-4 py-2">Leverancier Details</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->contact_person }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->number }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $user->mobile }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">
                            <div class="flex justify-center">
                                <a href="{{ route('user.show', $user->id) }}" class="text-blue-500">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-center">
        <div class="border-2 border-gray-400 px-4 py-2">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Home</a>
        </div>
    </div>
</x-app-layout>
