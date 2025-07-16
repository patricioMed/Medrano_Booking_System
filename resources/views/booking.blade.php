<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-8 lg:px-16 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Users</h3>
                <p class="text-3xl mt-2 text-indigo-600 dark:text-indigo-400">{{ $totalUsers }}</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Bookings</h3>
                <p class="text-3xl mt-2 text-green-600 dark:text-green-400">{{ $totalBookings }}</p>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Bookings Calendar</h3>
            <div id="calendar"></div>
        </div>
    </div>

    <!-- FullCalendar Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                events: @json($calendarEvents), // passed from controller
                eventColor: '#10B981'
            });

            calendar.render();
        });
    </script>
</x-app-layout>
