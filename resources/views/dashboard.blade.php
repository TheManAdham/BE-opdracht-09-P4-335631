<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Store Jamin') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <table class="table-auto border-collapse border-2 border-gray-500">
            <thead>
                <tr>
                    <th class="border-2 border-gray-400 px-4 py-2">Barcode</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Unit</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Amount</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Allergy Info</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Delivery Info</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->barcode }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->unit }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->amount !== null ? $product->amount : '0' }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">
                            <div class="flex justify-center">
                                <a href="{{ route('allergy.index', $product->id) }}" class="text-red-500">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </div>
                        </td>
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
