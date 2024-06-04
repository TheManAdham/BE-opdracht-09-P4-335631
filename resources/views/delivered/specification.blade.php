<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Specification Delivered Product') }}
        </h2>
    </x-slot>
    <div class="ml-10">
        <ul class="list-none">
            <li>Startdate: {{ isset($startDate) ? date('d-m-Y', strtotime($startDate)) : 'Not set' }}</li>
            <li>Enddate: {{ isset($endDate) ? date('d-m-Y', strtotime($endDate)) : 'Not set' }}</li>
            <li>Productname: {{ $product->name }}</li>
            <li>Allergies:
                @if(count($allergies) > 0)
                    @foreach($allergies as $key => $allergy)
                        {{ $allergy->name }}{{ $key != count($allergies)-1 ? ',' : '' }}
                    @endforeach
                @else
                    This product doesn't contain any allergies.
                @endif
            </li>
        </ul>
        <div class="py-12 flex">
            <table class="table-auto border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-400 px-4 py-2">Date Delivery</th>
                        <th class="border-2 border-gray-400 px-4 py-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->datedelivery }}</td>
                            <td class="border-2 border-gray-400 px-4 py-2">{{ $delivery->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
