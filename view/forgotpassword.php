<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forgotpassword.css">
    <title>Forgot Password</title>
</head>
<body>
    <header>
        <img src="../static/vibe.png" alt="Logo">
        <h1>CONNECT</h1>
    </header>
    <form action="forgotpassword.php" method="post" name="forgotpasswordform" id="forgotpassword">
        <h2>Find Your Account</h2>
        <p>Please enter your email or mobile phone number to search for your account.</p>
        <label for="email">Email or Phone:</label>
        <input type="text" id="email" name="email" placeholder="Email or Phone" required>

        <button type="submit">Search</button>

        <a class="btl" href="../view/signin.php"><u>Back to Login</u></a>
    </form>
</body>
</html>
