<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <title>Reset Password Page</title>
</head>
<body>
    <header>
        <img src="../static/vibe.png" alt="Logo">
        <h1>CONNECT</h1>
    </header>
        <div class="form">
            <form action="reset.php" method="post" name="resetForm" id="resetForm">
                <h2>Reset Password</h2>
                <p>Please choose a new password to finish signing in.</p>
                <div class="inputBox">
                    <input type="email" placeholder="Email" name="email" id="email">
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="New Password" name="password" id="password" required>
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Confirm Password" name="password" id="password" required>
                </div>
                <button type="submit" name="resetbtn" id="reset">Change Password</button>
            </form>
        </div>
</body>
</html>
