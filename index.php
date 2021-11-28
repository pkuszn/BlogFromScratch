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
    include('required_functions.php');
    ?>

</head>


<body>
<header class = "header">
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
                  if(isset($_SESSION['user'])){
                      echo "User: " . $_SESSION['user'];
                  }
                  else{
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
    <li><a href = "https://www.tutorialspoint.com/css">Article 1</a></li>
    <li><a href="www.google.pl">About php</a></li>
    <li><a href="Login_captcha/captcha.php">Test</a></li>
    <li id="oczko"><a href="Blackjack/blackjack.php">Blackjack</a></li>
    <li><a href="logout.php">Logout</a></li>

</ul>
</nav>

<div class="user-account-buttons">
    <span id="span-user-account">
        <a href="Login_captcha/captcha.php" id="login"">
                   <p class="user-account-labels">
                Login
            </p>

        </a>
        <div id="signup">
            <p class="user-account-labels">
                Sign up
            </p>
        </div>


    </span>

</div>


<div class="row">
    <div class="left-column">
        <div class="card">
            <?php
            if(isset($_POST['title']) and isset($_POST['post'])){
                $Title = $_POST['title'];
                $Post = $_POST['post'];
                echo "<h2>" . $Title . "</h2>";
                echo "</hr>";
                echo "<p>" . $Post . "</p>";
            }else{
                echo "<h2>Title</h2>";
                echo "</hr>";
                echo "<p>Post</p>";
            }
            ?>
        </div>
        <div id="post-popup">
            <div class="popup-header">
                <p class="popup-header">Create a new post</p>
                <img class="popup-header" src="Icons/remove-button.png" onclick="closeForm()" id="hidden-template-button"/>
            </div>
            <form method="POST">
                <div class="popup-cards">
                    <p>Title</p>
                    <input type="text" name="title" id="title" class="inputs"/>
                </div>
                <div class="popup-cards">
                    <p>Post message</p>
                    <textarea id="post" class="inputs" name="post" cols="1000" rows="10"></textarea>
                </div>
                <div class="popup-cards">
                    <input type="submit" value="add" id="post-button">
                </div>
            </form>
        </div>
        <input type="button" value="Add a new post" id="add-new-post" onclick="openForm()"/>
        <script type="text/javascript">
            function openForm(){
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
            <p class="about-author-description">I am a student of Computer Science at the University of Silesia</p>
        </div>
        <div class="right-card">
            <h2 class="article-headers">Quadratic Equations</h2>
            <br style="color: black"/>
            <form action="index.php" method="POST">
                <p>A: <input type="number" name="A" class="inputs"/></p>
                <p>B: <input type="number" name="B" class="inputs"/></p>
                <p>C: <input type="number" name="C" class="inputs"/></p>
                <input type="submit">
            </form>

            <?php
                if(isset($_POST['A']) and isset($_POST['B']) and isset($_POST['C'])){
                    $A = $_POST['A'];
                    $B = $_POST['B'];
                    $C = $_POST['C'];

                    echo '<hr/>';
                    quadraticEquation($A, $B, $C);
                }

            ?>
        </div>
    </div>
</div>
<div>
</div>


<footer style="text-align: center">
    <p>Created by Kuszneruk Patryk, spec ISI</p>
</footer>

</body>
</html>



