<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Repair Work - Login</title>
    <link rel="stylesheet" href="mainlogincss.css?v=1">
</head>
<body>

    <div class="banner">
        HOSTEL REPAIRWORK MANAGEMENT SYSTEM
    </div>

    <div class="login-container">
        <h1>LOGIN</h1>
        <form action="login_process.php" method="post"> <!-- Adjust action to your PHP login handler -->
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="uid" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>
