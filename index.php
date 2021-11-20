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
        <img id="image" src="Images/logo.jpg" alt="Flowers in Chania"/>
        <div class="bottom-left">Patryk Kuszneruk Blog</div>
    </div>
    <div>
    <?php
    DisplayDate();
    ?>
    </div>

</header>

<nav id="navigation">
<ul id="menu">
    <li><a href = "https://www.tutorialspoint.com/html">About me</a></li>
    <li><a href = "https://www.tutorialspoint.com/css">Article 1</a></li>
    <li><a href="www.google.pl">About php</a></li>
    <li id="button-row"><a href="Login_captcha/captcha.php">Log in</a></li>
    <li id="oczko"><a href="Blackjack/blackjack.php">Gra w oczko</a></li>
</ul>
</nav>

<div class="row">
    <div class="left-column">
        <div class="card">
            <h2 class="article-headers">Title</h2>
            <p class="article">Article text</p>
        </div>
        <div class="card">
            <h2 class="article-headers">Title</h2>
            <p class="article">Article text</p>
        </div>
        <div class="card">
            <h2 class="article-headers">Title</h2>
            <p class="article">Article text</p>
        </div>
        <div class="card">
            <h2 class="article-headers">Title</h2>
            <p class="article">Article text</p>
        </div>

    </div>
    <div class="right-column">
        <div class="right-card">
            <h2 class="article-headers">About me</h2>
            <p class="about-author-description">I am a student of Computer Science at the University of Silesia</p>
        </div>
        <div class="right-card">
            <h2 class="article-headers">Quadratic Equations</h2>
            <br style="color: black"/>

            <p>A: <input type="number" name="A"/></p>
            <p>B: <input type="number" name="B"/></p>
            <p>C: <input type="number" name="C"/></p>
            <hr/>
            <button type="reset">Solve</button>
            <br/>
            <?php
                quadraticEquation(2,2,-12);
            ?>
            <hr/>


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



