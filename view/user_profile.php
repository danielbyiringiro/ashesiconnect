<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user_profile.css">
    <title>User Profile</title>
</head>
<body>
    <header>
        <img src="../static/vibe.png" alt="Logo">
        <h1>CONNECT</h1>
    </header>
<div class="profile-container">
    <div class="profile-picture" id="profile-picture">
    <img src="../static/profilepic.jpg" alt="Profile Picture">
    </div>
    <div class="profile-name">Ashesi Connect</div>
    <div class="navigation">
    <a href="#">Friends</a>
    <a href="#">Photos</a>
    <a href="#">About</a>
    </div>
    <div class="user-info">
    <div><strong>Bio:</strong> be yoursed.</div>
    <div><strong>About Me:</strong> we are all humans.</div>
    <div><strong>Posts and Activities:</strong> This section shows the user's posts and activity on the platform.</div>
    <div><strong>Education and Work Experience:</strong> This section allows users to list their educational background and work experience.</div>
    <div><strong>Skills and Accomplishments:</strong> This section allows users to list their skills and accomplishments.</div>
    <div class="edit-bio">
    <button onclick="editBio()">Edit Bio</button>
    <button>Edit About Me</button>
    </div>
    </div>
    <div class="picture-section">
    <!-- Sample pictures -->
    <div class="picture" id="pic1">
    <img src="../static/ashesicampus.jpg" alt="Picture 1">
    <button class="delete-button">X</button>
    </div>
    <div class="picture" id="pic2">
    <img src="../static/pic2.jpg" alt="Picture 2">
    <button class="delete-button">X</button>
    </div>
    </div>
    <button class="add-picture-button" onclick="addPicture()">Add Picture</button>
    <div class="events-section">
    <h2>Events at School</h2>
    <div class="event">
    <div class="event-info">
    Aba Game at 8pm
    </div>
    <button class="add-to-calendar-button" onclick="addToCalendar(this)">Add to Calendar</button>
    </div>
    <div class="event">
    <div class="event-info">
    Tomorrow Town Hall Meeting at 4:30pm
    </div>
    <button class="add-to-calendar-button" onclick="addToCalendar(this)">Add to Calendar</button>
    </div>
    </div>
    <div class="friends-section">
    <div class="friend">
    <img src="../static/Share-Ashesi.jpg" alt="Friend 1">
    <div class="friend-name"> Micheal</div>
    </div>
    <div class="friend">
    <img src="../static/friend2.jpg" alt="Friend 2">
    <div class="friend-name">Scofield</div>
    </div>
    </div>
    </div>
<script>
function editBio() {
var newBio = prompt("Enter your new bio:");
if (newBio !== null) {
var bioElement = document.querySelector('.user-info div:nth-child(1)');
bioElement.innerHTML = "<strong>Bio:</strong> " + newBio;
}
}

function addPicture() {
var newPicSrc = prompt("Enter the URL of the picture:");
if (newPicSrc !== null) {
var pictureSection = document.querySelector('.picture-section');
var newPictureDiv = document.createElement('div');
newPictureDiv.classList.add('picture');
var newPictureImg = document.createElement('img');
newPictureImg.src = newPicSrc;
newPictureImg.alt = "Picture";
var deleteButton = document.createElement('button');
deleteButton.classList.add('delete-button');
deleteButton.innerText = "X";
newPictureDiv.appendChild(newPictureImg);
newPictureDiv.appendChild(deleteButton);
pictureSection.appendChild(newPictureDiv);
}
}

function addToCalendar(button) {
button.innerText = "Added";
}
</script>
</body>
</html>
