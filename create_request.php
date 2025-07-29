<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Repair Request</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
        }

        /* Container for Heading and Form */
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
            text-align: center;
        }

        /* Heading Styling */
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Form Styles */
        form {
            width: 100%;
            text-align: left;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        /* Form Fields */
        textarea, input[type="date"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Focus effect on inputs */
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #00b09b;
            background-color: #fff;
        }

        /* Button Style */
        button {
            width: 100%;
            padding: 12px;
            background-color: #00b09b;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #96c93d;
        }

        .dashboard-button {
            background-color: #333;
        }

        .dashboard-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Create Repair Request</h1>
        <form action="create_request_process.php" method="post" enctype="multipart/form-data">
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Describe the issue" required></textarea>

            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="general">General</option>
                <option value="room-specific">Room Specific</option>
            </select>

            <label for="type">Type:</label>
            <select name="type" id="type">
                <option value="electrician">Electrician</option>
                <option value="plumber">Plumber</option>
                <option value="other">Other</option>
            </select>

            <label for="expected_date">Expected Date:</label>
            <input type="date" name="expected_date" id="expected_date" required>

            <label for="image">Image (optional):</label>
            <input type="file" name="image" id="image">

            <button type="submit">Submit Request</button>
        </form>

        <!-- Button to go back to the Student Dashboard -->
        <button onclick="location.href='student_dashboard.php'" class="dashboard-button">Go to Dashboard</button>
    </div>
</body>
</html>
