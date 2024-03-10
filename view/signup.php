<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up Page</title>
</head>
<body>
    <header>
        <img src="../images/vibe.png" alt="Logo">
        <h1>CONNECT</h1>
    </header>
    <form action="../actions/signup_user.php" method="post" name="signupform" id="signup">
        <h2>Sign Up</h2>
        <div class="entries">
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
            <label for="fname" class="fname"></label>
            <input placeholder="First Name" type="fname" name="first_name" id="fname" value="<?php echo isset($_SESSION['signup_data']['first_name']) ? htmlspecialchars($_SESSION['signup_data']['first_name']) : ''; ?>">
            <label for="lname" class="lname"></label>
            <input placeholder="Last Name" type="lname" name="last_name" id="lname" value="<?php echo isset($_SESSION['signup_data']['last_name']) ? htmlspecialchars($_SESSION['signup_data']['last_name']) : ''; ?>">
            <label for="email"></label>
            <input placeholder="Email" type="email" name="emailaddress" id="emailaddress" value="<?php echo isset($_SESSION['signup_data']['emailaddress']) ? htmlspecialchars($_SESSION['signup_data']['emailaddress']) : ''; ?>">
            <label for="phone"></label>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" value="<?php echo isset($_SESSION['signup_data']['phone']) ? htmlspecialchars($_SESSION['signup_data']['phone']) : ''; ?>">
            <label for="password"></label>
            <input placeholder="Password" type="password" name="password" id="password" value="<?php echo isset($_SESSION['signup_data']['password']) ? htmlspecialchars($_SESSION['signup_data']['password']) : ''; ?>">
            <label for="major" class="mj" margin-top="10px" >Major</label>
            <select id="major" name="major" required>
                <option value="0" disabled selected>Select Major</option>
                <option value="Mechatronics" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Mechatronics') echo 'selected'; ?>>Mechatronics</option>
                <option value="Computer Engineering" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Computer Engineering') echo 'selected'; ?>>Computer Engineering</option>
                <option value="Electrical/Electronics Engineering" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Electrical/Electronics Engineering') echo 'selected'; ?>>Electrical/Electronics Engineering</option>
                <option value="Mechanical Engineering" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Mechanical Engineering') echo 'selected'; ?>>Mechanical Engineering</option>
                <option value="Computer Science" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                <option value="Management Information Systems" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Management Information Systems') echo 'selected'; ?>>Management Information Systems</option>
                <option value="Business Administration" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Business Administration') echo 'selected'; ?>>Business Administration</option>
                <option value="Economics" <?php if(isset($_SESSION['signup_data']['major']) && $_SESSION['signup_data']['major'] == 'Economics') echo 'selected'; ?>>Economics</option>
            </select>
            <label for="yeargroup" class="yg">Year Group</label>
            <select id="yrg" name="yeargroup">
                <option value="" disabled selected>Year</option>
                <?php
                $currentYear = date("Y");
                for ($year = 2002; $year <= $currentYear + 4; $year++) {
                    echo '<option value="' . $year . '"';
                    if (isset($_SESSION['signup_data']['yeargroup']) && $_SESSION['signup_data']['yeargroup'] == $year) echo ' selected';
                    echo '>' . $year . '</option>';
                }
                ?>
            </select>
            <label for="dob" class="DoB">Date of Birth</label>
            <input type="date" id="dob" name="dob" placeholder="YYYY-MM-DD" value="<?php echo isset($_SESSION['signup_data']['dob']) ? htmlspecialchars($_SESSION['signup_data']['dob']) : ''; ?>">
            <div id="gender" class="horizontal">
                <div>
                    <label for="gender" class="gen">Gender</label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="gender" id="male" value="0" <?php if (isset($_SESSION['signup_data']['gender']) && $_SESSION['signup_data']['gender'] == '0') echo 'checked'; ?>>
                        Male
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="gender" id="female" value="1" <?php if (isset($_SESSION['signup_data']['gender']) && $_SESSION['signup_data']['gender'] == '1') echo 'checked'; ?>>
                        Female
                    </label>
                </div>
            </div>
            <input type="hidden" name="selected_gender" id="selected_gender">
            <button type="submit" name="registerbtn" id="signup">Sign Up</button>
        </div>
        <p id="signinlink">Already have an account? <a href="../view/signin.php">Sign In</a></p>
    </form>
</body>
</html>
<script>// Get the current year
    document.getElementById("signup").addEventListener("submit", function(event) {
        var maleChecked = document.getElementById("male").checked;
        var femaleChecked = document.getElementById("female").checked;

        if (maleChecked) {
            document.getElementById("selected_gender").value = "0";
        } else if (femaleChecked) {
            document.getElementById("selected_gender").value = "1";
        } else {
            // If no gender is selected, prevent form submission
            event.preventDefault();
            alert("Please select your gender.");
        }
    });
</script>
