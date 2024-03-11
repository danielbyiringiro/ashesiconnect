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
        <title>New Post</title>
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
                            <li class="nav-item"><a class="nav-link navtypo" href="../actions/logout_user.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div>
            <div class="d-flex search-form flex-between">
                <input autocomplete="off" class="form-control me-2 search-input search-icon" type="search" placeholder="Search..." aria-label="Search" name="query" oninput="searchQuery()" required>
            </div>
            <div id="search-results"></div>   
            <main class="container-fluid py-5 text-center top">
                <div id="posttempcontainer">
                    <div class="post container" id="addText">
                        <form action="../actions/create_post.php" method="post" enctype="multipart/form-data" id="newpostform">
                            <?php 
                                if (!empty($_SESSION["error"])) {
                                    echo "<div>";
                                    foreach($_SESSION["error"] as $error)
                                    {
                                        echo "<p id='error_paragraph'>$error</p><br>";
                                    }
                                    echo "</div>";
                                } 
                            ?>
                            <a class="fullname">
                                <?php echo $_SESSION["username"] ?>
                            </a>
                            <br><br>
                            <textarea id="mytextarea" autofocus placeholder="What do you want to post ?" type="text" name="postContent" rows="10" cols="50"></textarea>
                            <div>
                                <div class="image_preview" style="display: none;">
                                    <img id="image_preview" src="" alt="Image Preview" style="margin-bottom: 5px;">
                                </div>
                                <div>
                                    <input autocomplete="off" class="form-control mx-auto w-auto smaller-input" value="Upload Image" id="image" name="image" type="file">
                                    <label for="image" id="uploadLabel" class="btn btn-secondary">Upload Image</label>
                                    <button class="btn btn-primary" type="submit">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
<script>
    const fileInput = document.getElementById('image');
    const uploadLabel = document.getElementById('uploadLabel');
    const previewContainer = document.querySelector('.image_preview');
    const textarea = document.getElementById('mytextarea');

    fileInput.addEventListener('change', () => 
    {
        const files = fileInput.files;
        if (files.length > 0)
        {
            uploadLabel.textContent = "Image Uploaded";
            previewContainer.style.display = 'block';
            document.getElementById('image_preview').src = URL.createObjectURL(files[0]);
            textarea.style.height = '50px';
        } 
        else
        {
            uploadLabel.textContent = "Upload Image";
        }
    });
</script>