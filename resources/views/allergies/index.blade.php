<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Allergies') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <form method="GET" action="{{ route('product-allergies') }}">
            <select name="allergy_id">
                <option value="">All</option>
                @foreach ($allergies as $allergy)
                    <option value="{{ $allergy->id }}" {{ request('allergy_id') == $allergy->id ? 'selected' : '' }}>{{ $allergy->name }}</option>
                @endforeach
            </select>
            <button type="submit">Make Selection</button>
        </form>
        <table class="table-auto border-collapse border-2 border-gray-500">
            <thead>
                <tr>
                    <th class="border-2 border-gray-400 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Name Allergy</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Description</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Amount</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Delivery Info</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->allergy_name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->allergy_description }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->amount !== null ? $product->amount : '0' }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">
                            <div class="flex justify-center">
                                <a href="{{ route('delivery.index', $product->id) }}" class="text-blue-500">
                                    <i class="fas fa-question-circle"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
