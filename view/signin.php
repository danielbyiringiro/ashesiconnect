<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <title>Sign In Page</title>
</head>
<body>
    <header>
        <img src="../images/vibe.png" alt="Logo">
        <h1>CONNECT</h1>
    </header>
    <div class="form">
        <form action="../actions/signin_user.php" method="post" name="signinForm" id="loginForm">
            <?php 
                if (!empty($_SESSION["errors"])) {
                    echo "<div>";
                    foreach($_SESSION["errors"] as $error)
                    {
                        echo "<p id='error_paragraph'>$error</p><br>";
                    }
                    echo "</div>";
                } 
            ?>
            <h2>Sign In</h2>
            <div class="inputBox">
                <input type="email" placeholder="Email" name="email" id="email" value="<?php echo isset($_SESSION['signup_data']['email']) ? htmlspecialchars($_SESSION['signup_data']['email']) : ''; ?>">
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Password" name="password" id="password">
            </div>
            <button type="submit" name="registerbtn" id="signup">Sign In</button>
            <p id="signuplink">Don't have an account? <a href="../view/signup.php">Sign Up</a></p>
            <a style="color:maroon" href="../view/forgotpassword.php">Forgot Password</a>
        </form>
    </div>
</body>
</html>
