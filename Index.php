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
                            location.href = "RegisterUser.php";
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
            $servername = "localhost";
            $username = "root";
            $password = "123456";

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                function_alert("Connection failed");
                function function_alert($msg) {
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
                
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";

            try{
                $host = "localhost";
                $user = "root";
                $pass = "123456";
                $db = "test2";

                $conn = mysqli_connect($host,$user,$pass, $db);

                $PostsTitle ="";
                $PostsText ="";
                $PostsCreatedDate = "";


                $sql = "select * from posts";
                $rs = mysqli_query($conn, $sql);
                while ($row = $rs->fetch_assoc()) {
                    $PostsTitle = $row['Posts_Title'];
                    $PostsText = $row['Posts_Text'];
                    $PostsCreatedDate = $row['Posts_CreatedDate'];
                }

                if(isset($PostsTitle) AND isset($PostsText) AND isset($PostsCreatedDate)){
                    echo "<h2>" . $PostsTitle . "</h2>";
                    echo "</hr>";
                    echo "<p>" . $PostsText . "</p>";
                    echo "<p style='text-align: right'>" . $PostsCreatedDate . "</p>";
                }
            } catch(mysqli_sql_exception $e){
                echo $e.message();
                $conn.rollback();
            }

            if (isset($_POST['title']) and isset($_POST['post'])) {
                $title = mysqli_real_escape_string($conn, $_REQUEST['title']);
                $post = mysqli_real_escape_string($conn, $_REQUEST['post']);
                $query = "INSERT INTO posts (Posts_Title, Posts_Text)
                VALUES ('$title', '$post')";
                if(mysqli_query($conn, $query)){
                    echo "Records added successfully.";
                } else{
                    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                }
            } else{
                echo 'Empty post';
            }

            ?>
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
            <p class="about-author-description">I am a student of Computer Science at the University of Silesia</p>
        </div>
        <div class="right-card">
            <h2 class="article-headers">Quadratic Equations</h2>
            <br style="color: black"/>
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
    </div>
</div>
<div>
</div>


<footer style="text-align: center">
    <p>Created by Kuszneruk Patryk, spec ISI</p>
</footer>

</body>
</html>



