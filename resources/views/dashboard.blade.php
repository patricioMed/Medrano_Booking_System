<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-image: linear-gradient(145deg, #0f0f0f, #1a1a1a);
        }

        .sidebar {
            width: 240px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .branding {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 16px;
            margin-top: 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: background 0.3s;
        }

        .sidebar nav a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-form button {
            width: 100%;
            background: rgba(255, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        .logout-form button:hover {
            background: rgba(255, 0, 0, 0.35);
        }

        .main-content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 900px;
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h1 {
            font-size: 30px;
            margin-bottom: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 16px;
            font-size: 18px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: translateY(-4px);
        }

        #calendar-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .flatpickr-calendar {
            background-color: #000 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.1);
        }

        .flatpickr-day,
        .flatpickr-months,
        .flatpickr-weekdays {
            color: #fff !important;
        }

        .flatpickr-day.selected {
            background: #fff !important;
            color: #000 !important;
        }

        .booked-day {
            background-color: red !important;
            color: white !important;
            font-weight: bold;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<aside class="sidebar">
    <div>
        <div class="branding">Medrano's Booking</div>
        <nav>
            <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('bookings.index') }}">📖 View Bookings</a>
            <a href="{{ route('bookings.create') }}">➕ Create Booking</a>
            <a href="{{ route('profile.edit') }}">👤 Edit Profile</a>
        </nav>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit">🚪 Logout</button>
    </form>
</aside>

<main class="main-content">
    <div class="container">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <div class="stats">
            <div class="box">
                📅 <strong>Total Bookings:</strong><br>{{ $totalBookings }}
            </div>
            <div class="box">
                👤 <strong>Total Users:</strong><br>{{ $totalUsers }}
            </div>
        </div>
        <div id="calendar-container">
            <input type="text" id="calendar" style="position: absolute; left: -9999px;">
        </div>
    </div>
</main>

<!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const bookedDates = @json($bookedDates ?? []);

    flatpickr("#calendar", {
        inline: true,
        appendTo: document.getElementById('calendar-container'),
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: bookedDates,
        onChange: function(selectedDates, dateStr) {
            alert("📅 Selected Date: " + dateStr);
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const date = dayElem.dateObj.toISOString().split('T')[0];
            if (bookedDates.includes(date)) {
                dayElem.classList.add('booked-day');
            }
        }
    }); -->
</script>
</body>
</html>
