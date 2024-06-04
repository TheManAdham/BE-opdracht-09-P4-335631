<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Leverancier') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div x-data="{ showError: true }" x-init="setTimeout(() => showError = false, 3000)" x-show="showError" class="bg-red-500 text-white px-4 py-2 mt-4">
            <div class="container mx-auto">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = '{{ route("user.show", $user->id) }}';
                }, 3000);
            </script>
        </div>
    @endif
    <div class="p-6 bg-white border-b border-gray-200 mx-auto max-w-7xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mt-4 flex justify-between items-center">
                        <label for="name" class="w-1/3">{{ __('Name') }}</label>
                        <input id="name" class="block mt-1 w-2/3" type="text" name="name" value="{{ $user->name }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="contact_person" class="w-1/3">{{ __('Contact Person') }}</label>
                        <input id="contact_person" class="block mt-1 w-2/3" type="text" name="contact_person" value="{{ $user->contact_person }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="number" class="w-1/3">{{ __('Number') }}</label>
                        <input id="number" class="block mt-1 w-2/3" type="text" name="number" value="{{ $user->number }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="mobile" class="w-1/3">{{ __('Mobile') }}</label>
                        <input id="mobile" class="block mt-1 w-2/3" type="text" name="mobile" value="{{ $user->mobile }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="street_name" class="w-1/3">{{ __('Street') }}</label>
                        <input id="street_name" class="block mt-1 w-2/3" type="text" name="street_name" value="{{ $user->street_name }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="house_number" class="w-1/3">{{ __('House Number') }}</label>
                        <input id="house_number" class="block mt-1 w-2/3" type="text" name="house_number" value="{{ $user->house_number }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="zip_code" class="w-1/3">{{ __('Zip Code') }}</label>
                        <input id="zip_code" class="block mt-1 w-2/3" type="text" name="zip_code" value="{{ $user->zip_code }}" required autofocus />
                    </div>


                    <div class="mt-4 flex justify-between items-center">
                        <label for="city" class="w-1/3">{{ __('City') }}</label>
                        <input id="city" class="block mt-1 w-2/3" type="text" name="city" value="{{ $user->city }}" required autofocus />
                    </div>

                    <div class="flex justify-center items-center mt-6 space-x-4">
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </button>
                        </div>
                        <div>
                            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Back
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Home
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
