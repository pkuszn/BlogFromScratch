
<!DOCTYPE html>
<html>
<video style="border: solid 2px black" id="film" autoplay="none" onended="stopgaleria()" autobuffer="true" width="854px" height="480px">
	<source src="Video/file_example_OGG_480_1_7mg.ogg">
</video>
<button type="button" onclick="startVideo()">Start</button>
<input type="range" min="0" max="100" id="range" step="1" value="0" onchange="moveFrames(this)"/>

<canvas id="galeria" width="1000px" height="600px">
<script type="text/javascript">
	// co ile milisekund aktualizowana jest galeria
	var updateInterval = 1000;
	// rozmiar klatek galerii
	var frameWidth = 200;
	var frameHeight = 125;
	// liczba klatek rejestrowana w galerii
	var frameRows = 20;
	var frameColumns = 20;
	var frameGrid = frameRows * frameColumns;
	// aktualna klatka
	var frameCount = 0;
	// zmienna pomocnicza do zatrzymania timer'a.
	var intervalId;
	var videoStarted = false;



    function moveFrames(duration){
       var film = document.getElementById("film");
       if(film != null || videoStarted == true){
            var time = film.duration * (duration.value / 100);
            film.currentTime = time;
       }
    }


	function startVideo() {

        // startuj timer tylko podczas pierwszego uruchomienia filmu
        if (videoStarted)
            return;
        videoStarted = true;
        // oblicz miejsce w galerii oraz zgodnie z timerem dokonaj jego aktualizacji
        updateFrame();
        intervalId = setInterval(updateFrame, updateInterval);
        // obsługa kliknięcia poszczególnej klatki galerii

        var galeria = document.getElementById("galeria");
        galeria.onclick = function(evt) {

            var offX = evt.pageX - galeria.offsetLeft;
            var offY = evt.pageY  - galeria.offsetTop;
            // ustal która klatka została kliknięta
            var clickedFrame = Math.floor(offY / frameHeight) * frameRows;
            clickedFrame += Math.floor(offX / frameWidth);

            // ustal która klatka filmu została kliknięta
            var seekedFrame = (((Math.floor(frameCount / frameGrid)) * frameGrid) + clickedFrame);
            // if the user clicked ahead of the current frame
            // then assume it was the last round of frames

            if (clickedFrame > (frameCount % 16))
                seekedFrame -= frameGrid;
            // nie przesuwaj przed początek filmu
            if (seekedFrame < 0)
                return;
            // przesuń video do zadanego momentu
            var video = document.getElementById("film");
            video.currentTime = seekedFrame * updateInterval / 1000;
            // zaaktualizuj zmienną pomocniczą na zadany moment filmu
            frameCount = seekedFrame;
        }
	}
	// narysuj klatkę filmu na płótnie galeria
	function updateFrame() {
        var video = document.getElementById("film");
        var galeria = document.getElementById("galeria");
        var ctx = galeria.getContext("2d");
        //przelicz gdzie powinna się znaleźć klatka i ją narysuj biorąc pod uwagę film jako źródło
        var framePosition = frameCount % frameGrid;
        var frameX = (framePosition % frameColumns) * frameWidth;
        var frameY = (Math.floor(framePosition / frameRows)) * frameHeight;
        ctx.drawImage(video, 0, 0, 400, 300, frameX, frameY, frameWidth, frameHeight);
        frameCount++;
    }
	// przestań generować klatki
	function stopgaleria() {
        clearInterval(intervalId);
    }
</script>
</html>