<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Appointment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-xl font-semibold mb-6">
                    Book Appointment
                </h1>
@if ($errors->any())

    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label>Service</label>

                        <select name="service_id"
                                class="w-full border rounded">

                            <option value="">Select Service</option>

                            @foreach ($services as $service)
        
                                <option value="{{ $service->id }}">
                                    {{ $service->Service_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Provider</label>

                        <select name="provider_id"
                                class="w-full text-black border rounded">

                            <option value="">Select Provider</option>

                            @foreach ($service_provider as $providers)
                            
                                <option value="{{ $providers->id }}">
                                    {{ $providers->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                 
                    <div class="mb-4">
                        <label>Booking Date</label>

                        <input type="date"
                               name="booking_date"
                               class="w-full text-black border rounded">
                    </div>

                 
                    <div class="mb-4">
                        <label>Booking Time</label>

                        <input type="time"
                               name="booking_time"
                               class="w-full text-black border rounded">
                    </div>

                    <button type="submit"
                            class="bg-green-400 text-white px-4 py-2 rounded">
                        Book Appointment
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>