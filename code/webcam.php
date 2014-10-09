<?php
#phpinfo();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="stuff, to, help, search, engines, not" name="keywords">
        <meta content="What this page is about." name="description">
        <meta content="Display Webcam Stream" name="title">
        <title>Display Webcam Stream</title>

        <style>
            #container {
                margin: 0px auto;
                width: 640px;
                height: 480px;
                border: 10px #333 solid;
            }
            #videoElement {
                width: 640px;
                height: 480px;
                background-color: #666;
            }
        </style>
    </head>

    <body>

        <div id="container">

            <video autoplay="true" id="videoElement">
            </video>

            <img id="image" src="">
            <!--<canvas style="display:none;"></canvas>-->
            <canvas id="canvas" style="border:1px solid #d3d3d3;"></canvas><br>
            <button onclick="snapshot()">Take Picture</button>

        </div>

        <script>
            var video = document.querySelector("#videoElement");
            var canvas = document.querySelector('#canvas');
            var ctx = canvas.getContext('2d');
            var localMediaStream = null;

            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

            var usermedia;
            if (navigator.getUserMedia) {
                console.log("get user media present");
                navigator.getUserMedia({video: true, audio: true}, handleVideo, videoError);
                console.log("got user media present");
            }

            function handleVideo(stream) {
                console.log("handling video start");
                video.src = window.webkitURL.createObjectURL(stream);
                localMediaStream = stream;
                console.log("handling video end");
            }

            function snapshot() {
                if (localMediaStream) {
                    //ctx.drawImage(video, 0, 0);
                    canvas.height = video.clientHeight;
                    canvas.width = video.clientWidth;
                    canvas.getContext('2d').drawImage(video, 0, 0);
                    // "image/webp" works in Chrome.
                    // Other browsers will fall back to image/png.
                    document.querySelector('img').src = canvas.toDataURL('image/webp');
                    //document.querySelector('#image').src = canvas.toDataURL('img');
                }
            }

            function stopWebCam() {
                if (video) {
                    video.pause();
                    video.src = '';
                    video.load();
                }

                if (localMediaStream && localMediaStream.stop) {
                    localMediaStream.stop();
                }
                localMediaStream = null;
            }
        </script>


    </body>
</html>
