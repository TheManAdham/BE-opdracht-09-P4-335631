<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overview Deliveries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-start mb-4 ml-4">
            <p>{{ __('Name User: ') . $user->name }}</p>
            <p>{{ __('Contact Person: ') . $user->contact_person }}</p>
            <p>{{ __('Number: ') . $user->number }}</p>
            <p>{{ __('Mobile: ') . $user->mobile }}</p>
        </div>

        <div class="ml-4">
            <table class="table-auto border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400 px-4 py-2">Product Name</th>
                        <th class="border-2 border-gray-400 px-4 py-2">Date Last Delivery</th>
                        <th class="border-2 border-gray-400 px-4 py-2">Amount</th>
                        <th class="border-2 border-gray-400 px-4 py-2">Date Next Delivery</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nextDelivery = $deliveries->where('store_amount', null)->sortBy('datenextdelivery')->first();
                    @endphp

                    @if ($nextDelivery)
                        <tr>
                            <td colspan="4" class="border-2 border-gray-400 px-4 py-2 text-center">
                                {{ __('There is currently no stock of this product, the expected next delivery is: ') . $nextDelivery->datenextdelivery }}
                            </td>
                        </tr>
                    @else
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->product_name }}</td>
                                <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->datedelivery }}</td>
                                <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->store_amount }}</td>
                                <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->datenextdelivery }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
