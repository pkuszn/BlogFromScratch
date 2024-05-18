<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="/Blackjack/style-blackjack.css"/>
    <title>Document</title>
</head>
<body style="background-color: white"onafterprint="" >
<img src="/Icons/previous.png" id="prev" class="top" onclick="backToMain()" />
<button type="button" onclick="redirectToVideo()">Video</button>
<script>
    function backToMain(){
        window.location.replace("/index.php");
    }
    function redirectToVideo(){
        window.location.replace("/TWI_lab/AudioVideo/Video.php");
    }
</script>
<header>
    <h1>Video & Audio</h1>
</header>

<div>
    <video id ="video" controls="controls" ="randomAudiosRandomTime()">
        <source src="Video/SampleVideo_1280x720_1mb.mp4" type="video/mp4"/>
    </video>
</div>

<hr/>

<div>
    <audio id="audio" controls preload="none"">
        <source type="audio/mp3"/>
    </audio>
    <script type="text/javascript">

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min)) + min;
        }

        /* Objects */
        var _player = document.getElementById('audio');

        /* Aplication */
        var tracks = [
            'Audio/sample1.mp3',
            'Audio/sample2.mp3',
            'Audio/sample3.mp3',
            'Audio/sample4.mp3',
            'Audio/sample5.mp3'
        ];

        function playNext() {
            var track = tracks[Math.floor(Math.random() * tracks.length)];
            var randtime = getRandomInt(0, track.duration);
            track.duration = randtime * (track.duration/ 100);
            _player.src = track;
            return _player.play();
        }

        /* Events */
        window.addEventListener('load', playNext);
        _player.addEventListener('ended', playNext);


    </script>

</div>



</body>
</html>
