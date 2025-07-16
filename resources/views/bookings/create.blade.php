<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(145deg, #0f0f0f, #1a1a1a);
        }

        .branding {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .container {
            max-width: 600px;
            width: 90%;
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 60px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #fff;
        }

        input[type="text"],
        textarea,
        button {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            backdrop-filter: blur(10px);
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 20px;
            background-color: rgba(0, 123, 255, 0.3);
            color: white;
            font-size: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: rgba(0, 123, 255, 0.6);
        }

        .error {
            color: #ff6b6b;
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
        }

        #calendar-container {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        #selected-date {
            margin-top: 15px;
            font-weight: bold;
            color: #fff;
            text-align: center;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Flatpickr Dark Theme Override */
        .flatpickr-calendar {
            background-color: #000 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.1);
        }

        .flatpickr-months,
        .flatpickr-weekdays {
            background-color: #000 !important;
            color: #fff !important;
            border-bottom: 1px solid #fff !important;
        }

        .flatpickr-day {
            color: #fff !important;
            border-radius: 8px !important;
        }

        .flatpickr-day:hover,
        .flatpickr-day:focus {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .flatpickr-day.today {
            border: 1px solid #fff !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: #fff !important;
            color: #000 !important;
            border: 1px solid #fff !important;
        }

        .flatpickr-day.disabled,
        .flatpickr-day.disabled:hover {
            background: #444 !important;
            color: #ccc !important;
            cursor: not-allowed !important;
        }

        .flatpickr-weekday {
            color: #fff !important;
        }

        .flatpickr-monthDropdown-months,
        .flatpickr-current-month input {
            background-color: #000 !important;
            color: #fff !important;
        }

        /* ✅ White arrows for navigation */
        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: #fff !important;
            fill: #fff !important;
        }

        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            stroke: #fff !important;
        }
        
    </style>
</head>
<body>

    <!-- Branding -->
    <div class="branding">
        Medrano's Booking System
    </div>

    <!-- Booking Form -->
    <div class="container">
        <h2>Create New Booking</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>

            <label for="booking_date">Booking Date:</label>
            <input type="text" id="booking_date" name="booking_date" required style="position: absolute; left: -9999px;">
            <div id="calendar-container"></div>
            <p id="selected-date"></p>

            <button type="submit">Book Now</button>
        </form>

        <a href="{{ route('dashboard') }}" class="back-btn">🔙 Back to Dashboard</a>
    </div>

    <!-- Calendar Script -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const bookedDates = @json($bookedDates ?? []);

        flatpickr("#booking_date", {
            inline: true,
            appendTo: document.getElementById('calendar-container'),
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedDates,
            onChange: function(selectedDates, dateStr) {
                document.getElementById('selected-date').innerText = "📅 Selected Date: " + dateStr;
            }
        });
    </script>

</body>
</html>
