<!DOCTYPE html>

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
<div id="info">
    <div class="about">
        <?php
        echo "User: 
        "
        ?>
    </div>
    <div class="about" id="date-time">
        <?php
        DisplayDate();
        ?>
    </div>
</div>


<nav id="navigation">
<ul id="menu">
    <li><a href = "https://www.tutorialspoint.com/html">About me</a></li>
    <li><a href = "https://www.tutorialspoint.com/css">Article 1</a></li>
    <li><a href="www.google.pl">About php</a></li>
    <li id="button-row"><a href="Login_captcha/captcha.php">Log in</a></li>
    <li id="oczko"><a href="Blackjack/blackjack.php">Blackjack</a></li>
</ul>
</nav>

<div class="row">
    <div class="left-column">
        <div class="card">
            <h2 class="article-headers">Title</h2>
            <p class="article">Article text</p>
        </div>
        <div id="post-popup">
            <div class="popup-header">
                <p class="popup-header">Create a new post</p>
                <img class="popup-header" src="Icons/remove-button.png" onclick="hidden()" id="hidden-template-button"/>
            </div>
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
        </div>
        <input type="button" value="Add a new post" id="add-new-post"/>
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



