
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
        <title>Home Page</title>
    </head>

    <body>
        <header>
            <nav>
                <div class="container-fluid">
                    <a class="navbar-brand flex-between begin" href="/"><span><img class="navpicture" src="../images/vibe.png" alt="Ashesi"></span><span> </span><span class="cc">CONNECT</span></a>
                    <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbar" data-bs-toggle="collapse" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ms-auto mt-2">
                            <li class="nav-item"><a class="nav-link navtypo" href="register.html">Sign Up</a></li>
                            <li class="nav-item"><a class="nav-link navtypo" href="login.html">Sign In</a></li>
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
        <div class="container">
            <form id="postForm" class="flex-container" method="POST" action="post.php">
                <!-- Assuming you'll have a session variable for user id -->
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <!-- Your post content input -->
                <textarea name="content" placeholder="What's on your mind?" class="inputbar" onclick="openPostEditor()" required></textarea>
                <!-- Add an option for uploading an image -->
                <input type="file" name="post_image">
                <!-- Submit button -->
                <button type="submit">Post</button>
            </form>
        </div>

                <div class="post-container">
                    <div class="post-header">
                        <a href="" class="header_link">
                            <img src="https://api.slingacademy.com/public/sample-photos/2.jpeg" class="horizontal-image" alt="Profile Picture">
                        </a>
                        <span class="post-username">
                            <p class="username"><a href="/users/">cynthiapowell</a></p>
                            <p class="belowtext">MIS C'24 |  2024-01-08 15:17:12</p>
                        </span>
                    </div>
                    <br>
                    <div class="post-content" id="postContent">
                        Protect watch toward end prepare south democratic. Street society body ready relate. World have sister right away.
                        Half Republican many sister reveal voice. Term wind bill many color. Reason what it officer glass sometimes ball serve.
                        Situation effort guy mouth marriage. Tonight right write term notice war. Chair difference continue thousand writer so.
                        Thank finish dog development sea deal after. Reflect section seek different assume hand change.
                    </div>
                    <div class="post-image-container">
                        <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/4.jpeg" alt="Post Image">
                    </div>
                    <div class="post-actions">
                        <div class="vibe-comment">
                            <button class="vibe-button">
                                <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                <strong>
                                    <span id="vibes-count-">659</span>
                                    <span class="strong">vibes</span>
                                </strong>
                            </button>
                            <button class="comment-button" onclick="loadComments()">
                                <img src="../images/comment.png" alt="comment">
                                <strong>
                                    <span id="comments-count-">34</span>
                                    <span class="strong">comments</span> 
                                </strong>
                            </button>
                        </div>
                        <div class="comment-section">
                            <div class="comment_area">
                                <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                <button>Post</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="post-container">
                    <div class="post-header">
                        <a href="" class="header_link">
                            <img src="https://api.slingacademy.com/public/sample-photos/1.jpeg" class="horizontal-image" alt="Profile Picture">
                        </a>
                        <span class="post-username">
                            <p class="username"><a href="/users/">katiemedina</a></p>
                            <p class="belowtext">BA C'27  |  2024-01-29 19:00:43</p>
                        </span>
                    </div>
                    <br>
                    <div class="post-content" id="postContent">
                        Finish try market realize site stage catch. Least right religious wait board perhaps. Situation exist movement happen firm raise.
                        Management reflect question catch modern almost. Gun future type include real measure head drive.
                        Use alone still keep within perform later garden. Smile explain writer fear subject scientist yes.
                        Somebody father sound few mission happy. Break increase poor each home. Who task scene phone natural hand military.
                    </div>
                    <div class="post-image-container">
                        <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/3.jpeg" alt="Post Image">
                    </div>
                    <div class="post-actions">
                        <div class="vibe-comment">
                            <button class="vibe-button" onclick="like()">
                                    <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                <strong>
                                    <span id="vibes-count-">482</span>
                                    <span class="strong">vibes</span>
                                </strong>
                            </button>
                            <button class="comment-button" onclick="loadComments()">
                                <img src="../images/comment.png" alt="comment">
                                <strong>
                                    <span id="comments-count-">56</span>
                                    <span class="strong">comments</span> 
                                </strong>
                            </button>
                        </div>
                        <div class="comment-section">
                            <div class="comment_area">
                                <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                <button>Post</button>
                            </div>
                        </div>
                    </div>
                    <div class="post-container">
                        <div class="post-header">
                            <a href="" class="header_link">
                                <img src="https://api.slingacademy.com/public/sample-photos/11.jpeg" class="horizontal-image" alt="Profile Picture">
                            </a>
                            <span class="post-username">
                                <p class="username"><a href="/users/">mary40</a></p>
                                <p class="belowtext">EEE C'25 |  2024-01-08 15:17:12</p>
                            </span>
                        </div>
                        <br>
                        <div class="post-content" id="postContent">
                            Protect watch toward end prepare south democratic. Street society body ready relate. World have sister right away.
                            Half Republican many sister reveal voice. Term wind bill many color. Reason what it officer glass sometimes ball serve.
                            Situation effort guy mouth marriage. Tonight right write term notice war. Chair difference continue thousand writer so.
                            Thank finish dog development sea deal after. Reflect section seek different assume hand change.
                        </div>
                        <div class="post-image-container">
                            <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/12.jpeg" alt="Post Image">
                        </div>
                        <div class="post-actions">
                            <div class="vibe-comment">
                                <button class="vibe-button">
                                    <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                    <strong>
                                        <span id="vibes-count-">884</span>
                                        <span class="strong">vibes</span>
                                    </strong>
                                </button>
                                <button class="comment-button" onclick="loadComments()">
                                    <img src="../images/comment.png" alt="comment">
                                    <strong>
                                        <span id="comments-count-">133</span>
                                        <span class="strong">comments</span> 
                                    </strong>
                                </button>
                            </div>
                            <div class="comment-section">
                                <div class="comment_area">
                                    <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                    <button>Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-container">
                        <div class="post-header">
                            <a href="" class="header_link">
                                <img src="https://api.slingacademy.com/public/sample-photos/8.jpeg" class="horizontal-image" alt="Profile Picture">
                            </a>
                            <span class="post-username">
                                <p class="username"><a href="/users/">solomonsandra</a></p>
                                <p class="belowtext">EEE C'24 |  2024-01-08 15:17:12</p>
                            </span>
                        </div>
                        <br>
                        <div class="post-content" id="postContent">
                            Protect watch toward end prepare south democratic. Street society body ready relate. World have sister right away.
                            Half Republican many sister reveal voice. Term wind bill many color. Reason what it officer glass sometimes ball serve.
                            Situation effort guy mouth marriage. Tonight right write term notice war. Chair difference continue thousand writer so.
                            Thank finish dog development sea deal after. Reflect section seek different assume hand change.
                        </div>
                        <div class="post-image-container">
                            <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/7.jpeg" alt="Post Image">
                        </div>
                        <div class="post-actions">
                            <div class="vibe-comment">
                                <button class="vibe-button">
                                    <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                    <strong>
                                        <span id="vibes-count-">210</span>
                                        <span class="strong">vibes</span>
                                    </strong>
                                </button>
                                <button class="comment-button">
                                    <img src="../images/comment.png" alt="comment">
                                    <strong>
                                        <span id="comments-count-">34</span>
                                        <span class="strong">comments</span> 
                                    </strong>
                                </button>
                            </div>
                            <div class="comment-section">
                                <div class="comment_area">
                                    <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                    <button>Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-container">
                        <div class="post-header">
                            <a href="" class="header_link">
                                <img src="https://api.slingacademy.com/public/sample-photos/9.jpeg" class="horizontal-image" alt="Profile Picture">
                            </a>
                            <span class="post-username">
                                <p class="username"><a href="/users/">scottalexis</a></p>
                                <p class="belowtext">BA C'27 |  2024-01-08 15:17:12</p>
                            </span>
                        </div>
                        <br>
                        <div class="post-content" id="postContent">
                            Protect watch toward end prepare south democratic. Street society body ready relate. World have sister right away.
                            Half Republican many sister reveal voice. Term wind bill many color. Reason what it officer glass sometimes ball serve.
                            Situation effort guy mouth marriage. Tonight right write term notice war. Chair difference continue thousand writer so.
                            Thank finish dog development sea deal after. Reflect section seek different assume hand change.
                        </div>
                        <div class="post-image-container">
                            <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/10.jpeg" alt="Post Image">
                        </div>
                        <div class="post-actions">
                            <div class="vibe-comment">
                                <button class="vibe-button">
                                    <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                    <strong>
                                        <span id="vibes-count-">413</span>
                                        <span class="strong">vibes</span>
                                    </strong>
                                </button>
                                <button class="comment-button" onclick="loadComments()">
                                    <img src="../images/comment.png" alt="comment">
                                    <strong>
                                        <span id="comments-count-">34</span>
                                        <span class="strong">comments</span> 
                                    </strong>
                                </button>
                            </div>
                            <div class="comment-section">
                                <div class="comment_area">
                                    <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                    <button>Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-container">
                        <div class="post-header">
                            <a href="" class="header_link">
                                <img src="https://api.slingacademy.com/public/sample-photos/5.jpeg" class="horizontal-image" alt="Profile Picture">
                            </a>
                            <span class="post-username">
                                <p class="username"><a href="/users/">daguilar</a></p>
                                <p class="belowtext">CS C'27 |  2024-01-09 15:17:12</p>
                            </span>
                        </div>
                        <br>
                        <div class="post-content" id="postContent">
                            Protect watch toward end prepare south democratic. Street society body ready relate. World have sister right away.
                            Half Republican many sister reveal voice. Term wind bill many color. Reason what it officer glass sometimes ball serve.
                            Situation effort guy mouth marriage. Tonight right write term notice war. Chair difference continue thousand writer so.
                            Thank finish dog development sea deal after. Reflect section seek different assume hand change.
                        </div>
                        <div class="post-image-container">
                            <img class="post-image" src="https://api.slingacademy.com/public/sample-photos/6.jpeg" alt="Post Image">
                        </div>
                        <div class="post-actions">
                            <div class="vibe-comment">
                                <button class="vibe-button">
                                    <img id="vibe-image-" data-post-id="" src="../images/vibe.png" alt="vibe">
                                    <strong>
                                        <span id="vibes-count-">559</span>
                                        <span class="strong">vibes</span>
                                    </strong>
                                </button>
                                <button class="comment-button" onclick="loadComments()">
                                    <img src="../images/comment.png" alt="comment">
                                    <strong>
                                        <span id="comments-count-">79</span>
                                        <span class="strong">comments</span> 
                                    </strong>
                                </button>
                            </div>
                            <div class="comment-section">
                                <div class="comment_area">
                                    <textarea class="comment-add" id="comment-input-" placeholder="Leave a comment..." required></textarea>
                                    <button>Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
        </div>
    </body>
</html>
