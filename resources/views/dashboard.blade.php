
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
@auth
    

         @if (auth()->user()->role !== 'admin')
            
    
            <div class="flex justify-end mb-6">
                <a href="{{ route('appointments.create') }}"
                   class="inline-block bg-green-400 hover:bg-green-600 text-white px-5 py-2 rounded-lg">
                    Add Appointment
                </a>
            </div>
@endauth
               @endif
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left text-gray-700">

                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 text-center">ID</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Time</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse ($appointment as $app)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4 text-center font-medium">
                                        {{ $app->id }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $app->booking_date }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $app->booking_time }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span id ="status-{{ $app->id }}" class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        <a href="{{ route('appointments.edit', $app->id) }}"
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            Edit
                                        </a>

                                        <form action="{{ route('appointments.destroy', $app->id) }}"
                                              method="POST"
                                              class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800 font-medium ml-4">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-8 text-center text-gray-500">
                                        No appointments found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        window.Echo.private('appointments.{{ auth()->id() }}')
            .listen('.appointment.status.updated', (event) => {

                console.log('EVENT RECEIVED:', event);

                const statusElement =
                    document.getElementById('status-' + event.appointment.id);

                if (statusElement) {
                    statusElement.innerText =
                        event.appointment.status.charAt(0).toUpperCase() +
                        event.appointment.status.slice(1);
                }

            });

    });
</script>
    document.addEventListener('DOMContentLoaded', function () {

        window.Echo.private('appointments.{{ auth()->id() }}')
            .listen('.appointment.status.updated', (event) => {

                const statusElement =
                    document.getElementById('status-' + event.appointment.id);

                if (statusElement) {
                    statusElement.innerText =
                        event.appointment.status.charAt(0).toUpperCase() +
                        event.appointment.status.slice(1);
                }

            });

    });
</script>