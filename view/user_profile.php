<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" rel="stylesheet">
        <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="/static/favicon.ico" rel="icon">
        <link href="../css/homepage.css" rel="stylesheet"> 
        <link href="../css/user_profile.css" rel="stylesheet"> 
        <title>User Profile</title>
        <script>

            document.addEventListener('DOMContentLoaded', () =>
            {
                const main = document.getElementById('main');
                const form = document.getElementById('posttempcontainer');
                form.style.display = 'none';
                
                console.log(`style for form is : ${form.style.display}`);

                fetch("../actions/loadUserPost.php", 
                {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then((response) => response.json())
                .then((data) => 
                {
                    if (data.length !== 0)
                    {
                        
                        var postHTML = data.map(post => 
                        {
                            const postImageContainer = post['picturepath'] !== 'N/A' ? `<div class="post-image-container"><img class="post-image" src="${post['picturepath']}" alt="Post Image"></div>` : '';
                            return  `<div class='post-container'>
                                        <div class='coming'>
                                            <div class='post-header'>
                                                <a class='header_link'>
                                                    <img src='${post['userPicture']}'  class='horizontal-image' alt='Profile Picture'>
                                                </a>
                                                <span class="post-username">
                                                    <p class="username"><a>${post['username']}</a></p>
                                                    <p class="belowtext">${post['class']} ${post['major']} | ${post['time']}</p>
                                                </span>
                                            </div>
                                            <div class="dropdown-container">
                                                <img src="../images/3dots.jpg" alt="3dots" class="dots" onclick="toggleDropdown(this)">
                                                <div class="dropdown-content" id="delete_post">
                                                    <a onclick="deletePost(${post['postId']})">Delete Post</a>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="post-content" id="postContent">
                                            ${post['content']}
                                        </div>
                                        ${postImageContainer}
                                        <div class="post-actions">
                                            <div class="vibe-comment">
                                                <button class="vibe-button">
                                                        <img id="vibe-image-${post['postId']}" data-post-id="" onclick="vibeClicked(${post['currentUser']}, ${post['postId']})" src="${post['src']}" alt="vibe">
                                                    <strong>
                                                        <span id="vibes-count-${post['postId']}">${post['vibes']}</span>
                                                        <span class="strong">vibes</span>
                                                    </strong>
                                                </button>
                                                <button class="comment-button" onclick="loadComments(${post['postId']})">
                                                    <img src="../images/comment.png" alt="comment">
                                                    <strong>
                                                        <span id="comments-count-${post['postId']}">${post['comments']}</span>
                                                        <span class="strong">comments</span> 
                                                    </strong>
                                                </button>
                                            </div>
                                            <div class="comment-section">
                                                <div class="comment_area">
                                                    <textarea class="comment-add" id="comment-input-${post['postId']}" placeholder="Leave a comment..." required></textarea>
                                                    <button onclick="addComment(${post['currentUser']}, ${post['postId']})">Post</button>
                                                </div>
                                                <div class="most_recent">
                                                    <span class='comment-username' id="comments-username-${post['postId']}">${post['most_recent_username'] ? post['most_recent_username'] : ''}</span>
                                                    <span id="comments-${post['postId']}">${post['most_recent_text'] ? post['most_recent_text'] : ''}</span>
                                                </div>
                                                <div id="display-comments-${post['postId']}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                        })
                        main.innerHTML += postHTML.join('');
                    }
                })
            });

            function toggleDropdown(image) 
            {
                var dropdownContent = image.nextElementSibling;
                dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
            }

            function deletePost(post_id) 
            {
                
                var confirmDelete = confirm("Are you sure you want to delete this post?");
                fetch("../actions/deletepost.php", 
                {
                    method: "POST",
                    headers: 
                    {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id : post_id})
                })
                .then((response) => response.json())
                .then((data) => 
                {
                    window.location.reload();
                });
            }

            function submitBio()
            {
                const newbio = document.getElementById("newbio");
                const value = newbio.value;

                fetch("../actions/changeBio.php", 
                {
                    method: "POST",
                    headers: 
                    {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({bio : value}),
                })
                .then((response) => response.json())
                .then((data) => 
                {
                    if (data['success'] === true)
                    {
                        window.location.href = "../actions/setSessionBio.php?bio=" + encodeURIComponent(data['newbio']);
                    }
                })
            }

            function editbio()
            {

                const div = document.getElementById("details");
                const oldHtml = div.innerHTML;
                div.innerHTML = '';

                div.innerHTML = `<div>
                                    <input id="newbio" type="text" placeholder="Type New Bio">
                                    <button class="btn btn-primary" onclick="submitBio()">Submit</button>
                                </div>`
                

            }

            function loadComments(post_id)
            {
                var commentsDiv = document.getElementById(`display-comments-${post_id}`);
                const commentSection = document.getElementById(`comments-${post_id}`);
                const commentUsername = document.getElementById(`comments-username-${post_id}`);

                if (commentsLoaded) { 
                    commentsDiv.innerHTML = '';
                    commentSection.classList.remove('disapear');
                    commentUsername.classList.remove('disapear');
                    commentsLoaded = false;
                    commentsDiv.classList.remove("displayComments");
                    return;
                }

                fetch("../actions/loadcomments.php", 
                {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({post_id: post_id}),
                })
                .then((res) => res.json())
                .then((data) => {
                    if (data['success'] === true)
                    {
                        var comments = data['comments'];
                        commentsDiv.classList.remove("displayComments");
                        commentSection.classList.add('disapear');
                        commentUsername.classList.add('disapear');
                        var commentHTML = comments.map(comment => {
                            return `<div class='comment_div'>
                                        <div class='comment_details'>
                                            <img src='${comment['picture']}' alt='${comment['username']}' class='comment_picture'>
                                            <div>
                                                <div class='comment_username'>
                                                    <p>${comment['username']}</p>
                                                </div>
                                                <div class='other_details'>
                                                    <p>${comment['class']}</p>
                                                    <p>${comment['major']}</p>
                                                    <p>${comment['time']}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='comment_text'>
                                            <p>${comment['text']}</p>
                                        </div>
                                    </div>`
                        })

                        commentsDiv.innerHTML = commentHTML.join('');
                        commentsLoaded = true;
                        console.log('Received');
                    }});
            }
            function vibeClicked(user_id, post_id)
            {
                const image = document.getElementById(`vibe-image-${post_id}`);
                const count = document.getElementById(`vibes-count-${post_id}`);

                fetch('../actions/vibeorunvibe.php', 
                {
                    method : 'POST',
                    headers:
                    {
                        'Content-Type' : 'application/json',
                    },
                    body :JSON.stringify(
                    {
                        postId :post_id,
                        userId :user_id
                    })
                })
                .then(response => response.json())
                .then(data => 
                {
                    count.textContent = data['likes'];
                    image.src = data['image_src'];
                })
                
            }

            function addComment(user_id, post_id) 
            {
                const commentInput = document.getElementById(`comment-input-${post_id}`);
                const commentCount = document.getElementById(`comments-count-${post_id}`);
                const comment = commentInput.value;

                if (comment.trim() === '') 
                {
                    return;
                }

                const commentData = {
                    post_id: post_id,
                    text: comment,
                    user_id: user_id,
                };

                console.log(commentData);

                fetch('../actions/addcomment.php', 
                {
                    method :'POST',
                    headers : {
                        'Content-Type': 'application/json',
                    },

                    body: JSON.stringify(commentData),
                })
                .then((res) => res.json())
                .then((data) => {

                    if (data['success'] === true)
                    {
                        commentInput.value = '';
                        commentCount.innerHTML = data['count'];
                        const comment_text = data['text'];
                        const comment_username = data['username'];
                        const commentSection = document.getElementById(`comments-${post_id}`);
                        const commentUsername = document.getElementById(`comments-username-${post_id}`);
                        commentSection.innerHTML = comment_text;
                        commentUsername.classList.add('comment-username');
                        commentUsername.innerHTML = comment_username;
                    }
                    else
                    {
                        console.log(data);
                    }

                });


            }

            function editPicture() 
            {
                const div = document.getElementById('posttempcontainer');
                div.style.display = 'block';

                div.innerHTML = `
                    <div class="post container editPictureContainer">
                        <form action="../actions/updatepicture.php" method="post" enctype="multipart/form-data" id="newpostform">
                            <div>
                                <div class="image_preview" style="display:none;">
                                <img id="image_preview" src="" alt="Image Preview" style="margin-bottom: 5px; width: 100%; height: 100%;">
                                </div>
                                <div>
                                    <input autocomplete="off" class="form-control mx-auto w-auto smaller-input" value="Upload Image" id="image" name="image" type="file">
                                    <label for="image" id="uploadLabel" class="btn btn-secondary">Upload Image</label>
                                    <button class="btn btn-primary" type="submit" onclick="submitForm()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                `;

                const fileInput = document.getElementById('image');
                const uploadLabel = document.getElementById('uploadLabel');
                const previewContainer = document.querySelector('.image_preview');

                fileInput.addEventListener('change', () => {
                    const files = fileInput.files;
                    if (files.length > 0)
                    {
                        uploadLabel.textContent = "Image Uploaded";
                        previewContainer.style.display = 'block';
                        document.getElementById('image_preview').src = URL.createObjectURL(files[0]);
                    } 
                });
            }

            function submitForm() 
            {
                const form = document.getElementById('newpostform');
                form.submit();
            }
        </script>
    </head>
    <body>
        <header>
            <nav class="navbar-expand-md navbar">
                <div class="container-fluid">
                    <a class="navbar-brand flex-between begin" href="homepage.php"><span><img class="navpicture" src="../images/vibe.png" alt="Ashesi"></span><span> </span><span class="cc">CONNECT</span></a>
                    <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbar" data-bs-toggle="collapse" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ms-auto mt-2">
                            <li class="nav-item"><a style="color: white;" class="nav-link navtypo" href="../actions/logout_user.php">Log Out</a></li>
                            <li class="nav-item"><a style="color: white;" class="nav-link navtypo" href="user_profile.php">Profile</a><li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="d-flex search-form flex-between">
                <input autocomplete="off" class="form-control me-2 search-input search-icon" type="search" placeholder="Search..." aria-label="Search" name="query" oninput="searchQuery()" required>
        </div>
        <div id="search-results"></div>
        <main id='main' class="container-fluid py-5 text-center top">
            <div class="container">
                <div class="profile-picture" >
                    <img id="profile-picture" src="<?php echo $_SESSION['picturePath']?>" alt="Profile Picture">
                </div>
                <div class="profile-name" id="details">
                    <p class="belowtext"><?php echo $_SESSION['username']. " " . $_SESSION['major'] . " " .$_SESSION['year'] ?></p>
                    <p class="belowtext">Joined: <?php echo $_SESSION['joined'] ?></p>
                    <p class="belowtext">Bio: <?php echo $_SESSION['bio'] ?> </p>
                    <button class="btn btn-secondary" onclick="editbio()">Edit Bio</button>
                    <button class="btn btn-secondary" id="upload_pic" onclick="editPicture()">Edit Picture</button>
                </div>
            </div>
            <div id="posttempcontainer"></div>
        </main>
    </body>
</html>