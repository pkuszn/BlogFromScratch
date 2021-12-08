<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Patryk Kuszneruk</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
    <?php
    include('RequiredFunctions.php');
    ?>
</head>

<body>
<header class="header">
    <div class="container">
        <img id="image" src="logo.jpg" alt="Flowers in Chania"/>
        <div class="bottom-left">Patryk Kuszneruk Blog</div>
    </div>
    <div>
    </div>
</header>
<div class="topbars">
    <div class="topbars-containers" id="topbars-containers-date">
        <span class="span-containers">
                   <?php
                   DisplayDate();
                   ?>
        </span>
    </div>
    <div class="topbars-containers" id="topbars-containers-search">
        <span class="span-containers" id="search">
            <div class="search-container">
                <p>Search articles: </p>
            </div>
            <div class="search-container">
                <input type="text" placeholder="Input text"/>
            </div>

        </span>
    </div>
    <div class="topbars-containers" id="topbars-containers-user-account">
        <span class="span-containers">
            <span id="user-session">
                  <?php
                  if (isset($_SESSION['user'])) {
                      echo "User: " . $_SESSION['user'];
                  } else {
                      echo "User: not logged in";
                  }
                  ?>
            </span>
            <span>
                <img src="Icons/user.png"/>
            </span>
        </span>
    </div>
</div>

<nav id="navigation">
    <ul id="menu">
        <li><a href="https://www.tutorialspoint.com/css">Article 1</a></li>
        <li><a href="www.google.pl">About php</a></li>
        <li><a href="Login_captcha/Captcha.php">Test</a></li>
        <li id="oczko"><a href="Blackjack/BlackjackGame.php">Blackjack</a></li>
        <li><a href="Logout.php">Logout</a></li>
    </ul>
</nav>

<div class="user-account-buttons">
    <span id="span-user-account">
        <a href="Login_captcha/Captcha.php" id="login"">
                   <p class="user-account-labels">
                Login
            </p>
        </a>
        <div id="signup" typeof="button" onclick="redirectToRegisterView()">
            <p class="user-account-labels">
                Sign up
                <script type="text/javascript">
                    function redirectToRegisterView() {
                        document.getElementById(("signup")).onclick = function () {
                            location.href = "Register/RegisterUser.php";
                        }
                    }
                </script>
            </p>
        </div>
    </span>
</div>

<div class="row">
    <div class="left-column">
        <div class="card">
            <?php
            require("Connection.php");
            $conn = establishConnection();
            try{
                $PostsTitle ="";
                $PostsText ="";
                $PostsCreatedDate = "";
                $sql = "select * from posts";
                $rs = mysqli_query($conn, $sql);

                while ($row = $rs->fetch_assoc()) {
                    $PostsTitle = $row['Post_title'];
                    $PostsText = $row['Post_message'];
                    $PostsCreatedDate = $row['Post_created_date'];
                }

                if(isset($PostsTitle) AND isset($PostsText) AND isset($PostsCreatedDate)){
                    echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
                    echo "<hr>";
                    echo "</hr>";
                    echo "<p class='post-text'>" . $PostsText . "</p>";
                    echo "<p class='post-date''>" . $PostsCreatedDate . "</p>";
                }

            } catch(mysqli_sql_exception $e){
                echo $e.mysqli_stmt_error($rs);
                $conn.mysqli_rollback($rs);
            }

            if (isset($_POST['title']) and isset($_POST['post'])) {
                $title = mysqli_real_escape_string($conn, $_REQUEST['title']);
                $post = mysqli_real_escape_string($conn, $_REQUEST['post']);
                $query = "INSERT INTO posts (Post_title, Post_message)
                VALUES ('$title', '$post')";
                if(mysqli_query($conn, $query)){
                    $_SESSION['db_status'] = "Records added successfully";
                    echo "<meta http-equiv='refresh' content='0'>";
                } else{
                    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                }
            } else{
                echo 'Create a new post';
            }

            ?>
            <div class="commentary-container">
                <div id="commentary-section">
                    <div id="comment" class="commentary-header">
                        <img src="Icons/remove-button.png" onclick="closeComment()" id="commentary-hidden-button"/>
                    </div>
                </div>
                <script>
                    function openComment() {
                        document.getElementById("commentary-section").style.display = "inline-block";
                    }

                    function closeComment() {
                        document.getElementById("commentary-section").style.display = "none";
                    }
                </script>
                <input type="button" value="Add a commentary" id="button-commentary" onclick="openComment()"/>
            </div>
        </div>
        <div id="post-popup">
            <div class="popup-header">
                <p class="popup-header">Create a new post</p>
                <img class="popup-header" src="Icons/remove-button.png" onclick="closeForm()"
                     id="hidden-template-button"/>
            </div>
            <form method="POST">
                <div class="popup-cards">
                    <p>Title</p>
                    <input type="text" name="title" id="title" class="inputs" required/>
                </div>
                <div class="popup-cards">
                    <p>Post message</p>
                    <textarea id="post" class="inputs" name="post" cols="1000" rows="10" required></textarea>
                </div>
                <div class="popup-cards">
                    <input type="submit" value="add" id="post-button">
                </div>
            </form>
        </div>
        <input type="button" value="Add a new post" id="add-new-post" onclick="openForm()"/>
        <script type="text/javascript">
            function openForm() {
                document.getElementById("post-popup").style.display = "block";
            }

            function closeForm() {
                document.getElementById("post-popup").style.display = "none";
            }
        </script>
    </div>
    <div class="right-column">
        <div class="right-card">
            <h2 class="article-headers">About me</h2>
            <hr>
            <p class="about-author-description">I am a student of Computer Science at the University of Silesia</p>
        </div>
        <div class="right-card">
            <h2 class="article-headers">Quadratic Equations</h2>
            <hr>
            <form action="Index.php" method="POST">
                <p>A: <input type="number" name="A" class="inputs"/></p>
                <p>B: <input type="number" name="B" class="inputs"/></p>
                <p>C: <input type="number" name="C" class="inputs"/></p>
                <input type="submit">
            </form>

            <?php
            if (isset($_POST['A']) and isset($_POST['B']) and isset($_POST['C'])) {
                $A = $_POST['A'];
                $B = $_POST['B'];
                $C = $_POST['C'];

                echo '<hr/>';
                quadraticEquation($A, $B, $C);
            }

            ?>
        </div>
        <div class="right-card">
            <h2 class="article-headers">TIWP lab exercises</h2>
            <hr>
            <li class="TWI-list"><a href="TWI_lab/Canvas/Canvas.php">Canvas</a></li>
            <li class="TWI-list">Audio</li>
            <li class="TWI-list"><a href="TWI_lab/FormHTML4/FormHTML4.php">Form HTML4</a></li>
            <li class="TWI-list"><a href="TWI_lab/FormHTML5/FormHTML5.php">Form HTML5</a></li>
            <li class="TWI-list">XML</li>
            <li class="TWI-list">jQuery</li>
            <li class="TWI-list">Snake jQuery</li>
            <li class="TWI-list">Project</li>
        </div>
    </div>
</div>
<div>
</div>

<div class="debug">
    <?php
    echo "connection_status: " . $_SESSION['connection-status'] . "\n";
    echo "db_status: " .  $_SESSION['db_status'] . "\n";
    echo "user: ".  $_SESSION['user'];
    ?>
</div>
<footer style="text-align: center">
    <p>Created by Kuszneruk Patryk, spec ISI</p>
</footer>
</body>
</html>



