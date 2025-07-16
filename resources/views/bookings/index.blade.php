<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bookings</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #000;
            color: #fff;
            margin: 0;
            padding: 40px;
            background-image: linear-gradient(145deg, #0f0f0f, #1a1a1a);
            min-height: 100vh;
        }

        .branding {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .top-bar a {
            text-decoration: none;
            background: rgba(0, 123, 255, 0.2);
            color: #fff;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: background 0.3s;
        }

        .top-bar a:hover {
            background-color: rgba(0, 123, 255, 0.4);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            text-align: left;
            color: #fff;
        }

        th {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .no-bookings {
            text-align: center;
            background: rgba(255, 193, 7, 0.1);
            padding: 20px;
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 8px;
            margin-top: 20px;
        }

        .success-message {
            background-color: rgba(40, 167, 69, 0.2);
            color: #d4edda;
            padding: 15px;
            border: 1px solid rgba(40, 167, 69, 0.3);
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons a,
        .action-buttons form button {
            background-color: rgba(0, 123, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: background 0.3s;
        }

        .action-buttons a.edit-btn {
            background-color: rgba(255, 193, 7, 0.2);
        }

        .action-buttons a.edit-btn:hover {
            background-color: rgba(255, 193, 7, 0.4);
        }

        .action-buttons form button.delete-btn {
            background-color: rgba(220, 53, 69, 0.2);
        }

        .action-buttons form button.delete-btn:hover {
            background-color: rgba(220, 53, 69, 0.4);
        }

        .action-buttons a:hover,
        .action-buttons form button:hover {
            background-color: rgba(0, 123, 255, 0.4);
        }
    </style>
</head>
<body>

    <!-- ✅ Branding -->
    <div class="branding">
        Medrano's Booking System
    </div>

    <div class="container">
        <h1>📅 View Your Bookings</h1>

        <!-- ✅ Success Message -->
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ Navigation -->
        <div class="top-bar">
            <a href="{{ route('dashboard') }}">🏠 Back to Dashboard</a>
            <a href="{{ route('bookings.create') }}">➕ Create New Booking</a>
        </div>

        <!-- ✅ Bookings Table -->
        @if($bookings->isEmpty())
            <div class="no-bookings">You don't have any bookings yet.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Booking Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</td>
                            <td>{{ $booking->description }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="edit-btn">✏️ Edit</a>

                                    <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this booking?')">🗑️ Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</body>
</html>
