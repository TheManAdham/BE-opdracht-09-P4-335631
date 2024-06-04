<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Allergies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-start mb-4 ml-4">
            <p>{{ __('Product Name: ') . $product->name }}</p>
            <p>{{ __('Barcode: ') . $product->barcode }}</p>
        </div>

        <div class="ml-4">
            <table class="table-auto border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400 px-4 py-2">Name</th>
                        <th class="border-2 border-gray-400 px-4 py-2">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allergies as $allergy)
                        <tr>
                            <td class="border-2 border-gray-400 px-4 py-2">{{ $allergy->name }}</td>
                            <td class="border-2 border-gray-400 px-4 py-2">{{ $allergy->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border-2 border-gray-400 px-4 py-2 text-center">{{ __('This product doesn\'t contain allergic substances.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
