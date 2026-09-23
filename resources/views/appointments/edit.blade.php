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
                    Edit Appointment
                </h1>

                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Service</label>

                        <select name="service_id"
                                class="w-full border rounded">

                            <option value="">Select Service</option>

                            @foreach ($services as $service)
        
                                <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
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
                                <option value="{{ $providers->id }}" {{ $appointment->provider_id == $providers->id ? 'selected' : '' }}>
                                    {{ $providers->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Booking Date</label>

                        <input type="date"
                               name="booking_date"
                               value="{{ $appointment->booking_date }}"
                               class="w-full text-black border rounded">
                    </div>
                    <div class="mb-4">
                        <label>Booking Time</label>

                        <input type="time"
                               name="booking_time"
                               value="{{ $appointment->booking_time }}"
                               class="w-full text-black border rounded">
                    </div>
                  @auth
    @if (auth()->user()->role === 'admin')
        <div class="mb-4">
            <label>Status</label>

            <select name="status" class="w-full text-black border rounded">
                <option value="pending"
                    {{ $appointment->status === 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="confirmed"
                    {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>
                    Confirmed
                </option>

                <option value="processing"
                    {{ $appointment->status === 'processing' ? 'selected' : '' }}>
                    Processing
                </option>

                <option value="completed"
                    {{ $appointment->status === 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

                <option value="cancelled"
                    {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
        </div>
    @endif
@endauth
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Appointment
                    </button>
                    

                </form>

            </div>

        </div>
    </div>

</x-app-layout>