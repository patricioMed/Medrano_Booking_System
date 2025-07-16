<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
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
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 60px;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #fff;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            backdrop-filter: blur(4px);
        }

        form input::placeholder,
        form textarea::placeholder {
            color: #ccc;
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

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .btn-group button,
        .btn-group a {
            text-decoration: none;
            background: rgba(0, 123, 255, 0.2);
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            transition: background 0.3s;
        }

        .btn-group a {
            background: rgba(108, 117, 125, 0.2);
        }

        .btn-group button:hover {
            background: rgba(0, 123, 255, 0.4);
        }

        .btn-group a:hover {
            background: rgba(108, 117, 125, 0.4);
        }

        .error {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Calendar Styles */
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

        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            stroke: #fff !important;
        }
    </style>
</head>
<body>

    <!-- Top-left branding -->
    <div class="branding">
        Medrano's Booking System
    </div>

    <div class="container">
        <h1>Edit Booking</h1>

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title', $booking->title) }}" required>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="booking_date">Booking Date</label>
            <input type="text" id="booking_date" name="booking_date" required value="{{ old('booking_date', $booking->booking_date) }}" style="position: absolute; left: -9999px;">
            <div id="calendar-container"></div>
            <p id="selected-date">📅 Selected Date: {{ old('booking_date', $booking->booking_date) }}</p>
            @error('booking_date')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="description">Description</label>
            <textarea name="description" rows="4">{{ old('description', $booking->description) }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="btn-group">
                <a href="{{ route('bookings.index') }}">Cancel</a>
                <button type="submit">Update Booking</button>
            </div>
        </form>
    </div>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const bookedDates = @json($bookedDates ?? []);

        flatpickr("#booking_date", {
            inline: true,
            appendTo: document.getElementById('calendar-container'),
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedDates,
            defaultDate: "{{ old('booking_date', $booking->booking_date) }}",
            onChange: function(selectedDates, dateStr) {
                document.getElementById('selected-date').innerText = "📅 Selected Date: " + dateStr;
            }
        });
    </script>
</body>
</html>
