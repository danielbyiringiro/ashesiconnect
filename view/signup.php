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
    <form>
        <h2>Sign Up</h2>
        <form action="signup.php" method="post" name="signupform" id="signup">
            <div class="entries">
            <label for="fname" class="fname"></label>
            <input placeholder="First Name" type="fname" name="first name" id="fname" required>
            <label for="lname" class="lname"></label>
            <input placeholder="Last Name" type="lname" name="last name" id="lname" required>
            <label for="email"></label>
            <input placeholder="Email" type="email" name="email address" id="emailaddress" required>
            <label for="phone"></label>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
            <label for="password"></label>
            <input placeholder="Password" type="password" name="password" id="password" required>
            <label for="major" class="mj" margin-top="10px" >Major</label>
            <select id="major" name="major">
                <option value="Mechatronics">Mechatronics</option>
                <option value="Computer Engineering">Computer Engineering</option>
                <option value="Electrical/Electronics Engineering">Electrical/Electronics Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Management Information Systems">Management Information Systems</option>
                <option value="Business Administration">Business Administration</option>
                <option value="Economics">Economics</option>
            </select>
            <label for="yeargroup" class="yg">Year Group</label>
            <select id="yrg" name="yeargroup"></select>
            <label for="dob" class="DoB">Date of Birth</label>
            <input type="date" id="dob" name="dob" placeholder="YYYY-MM-DD" required>      
            <br> 
            <div>
                <label for="gender" class="gen">Gender ?</label>
                <label for="0-Male" class="male">Male</label>
                <input type="radio" name="male" id="male" class="male">
                <label for="1-Female" class="female">Female</label>
                <input type="radio" name="female" id="female" class="female" required>
            </div>
            <button type="submit" name="registerbtn" id="signup">Sign Up</button>
        </form>
        <p id="signinlink">Already have an account? <a href="../view/signin.php">Sign In</a></p>
</body>
</html>
<script>// Get the current year
    var currentYear = new Date().getFullYear();
    
    // Get the select element
    var selectElement = document.getElementById("yrg");
    
    // Loop from 2002 to the current year and create options
    for (var year = 2002; year <= currentYear; year++) {
        var option = document.createElement("option");
        option.text = year;
        option.value = year;
        selectElement.add(option);
    }
</script>
