<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Delivered Products') }}
        </h2>
    </x-slot>
    <form method="GET" action="{{ route('product-delivered') }}" class="flex flex-wrap justify-center">
        <div class="mb-4 mr-2">
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4 mr-2">
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Maak selectie</button>
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="resetForm()">Clear Filter</button>
        </div>
    </form>
    <div class="py-12 flex justify-center">
        <table class="table-auto border-collapse border-2 border-gray-500">
            <thead>
                <tr>
                    <th class="border-2 border-gray-400 px-4 py-2">Name Leverancier</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Contact Person</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Product Name</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Total delivered</th>
                    <th class="border-2 border-gray-400 px-4 py-2">Specification</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->user_name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->contact_person }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->product_name }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">{{ $product->total_amount !== null ? $product->total_amount : '0' }}</td>
                        <td class="border-2 border-gray-400 px-4 py-2">
                            <a href="{{ route('product-delivered-specification', ['product' => $product->product_id, 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}">?</a>                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="border-2 border-gray-400 px-4 py-2 text-center" colspan="5">No products found in this period</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        function resetForm() {
            document.getElementById("start_date").value = "";
            document.getElementById("end_date").value = "";
        }
        </script>
</x-app-layout>
