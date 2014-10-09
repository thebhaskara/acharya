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
    <!--><canvas style="display:none;"></canvas><!-->
    <canvas id="canvas" width="1280" height="720" style="border:1px solid #d3d3d3;"></canvas><br>
    <button onclick="snapshot()">Take Picture</button>

</div>

<script>
 var video = document.querySelector("#videoElement");
 var canvas = document.querySelector('#canvas');
 var ctx = canvas.getContext('2d');
 var localMediaStream = null;
 console.log("getting user media present");

var hdConstraints = {
  video: {
    mandatory: {
      minWidth: 1024,
      minHeight: 768
    }
  },
    audio: true
};

var vgaConstraints = {
  video: {
    mandatory: {
      minWidth: 480,
      minHeight: 240
    }
  },
    audio: true
};

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
console.log("get user media present");
    //navigator.getUserMedia({video: true, audio: true}, handleVideo, videoError);
    navigator.getUserMedia(hdConstraints, handleVideo, videoError);
    console.log("got user media present");
}

function handleVideo(stream) {
    console.log("handling video start");
    video.src = window.webkitURL.createObjectURL(stream);

    //if (window.webkitURL)
    //{
    //    console.log("stream for chrome");
    //    video.src = window.webkitURL.createObjectURL(stream);
    //}
    //else if((video.mozSrcObject !== undefined))
    //{
    //    console.log("stream for firefox");
    //    video.mozSrcObject = stream;
    //}
    //else
    //{
    //    console.log("stream for nothing");
    //}
    localMediaStream = stream;
    //sleep(20000);
    //stopWebCam();
    //snapshot();
    console.log("handling video end");
}

function snapshot() {
    if (localMediaStream) {
      ctx.drawImage(video, 0, 0);
      // "image/webp" works in Chrome.
      // Other browsers will fall back to image/png.
      //document.querySelector('img').src = canvas.toDataURL('image/webp');
        //document.querySelector('#image').src = canvas.toDataURL('img');
    }
  }

function stopWebCam() {
    if (video) {
        video.pause();
        video.src = '';
        video.load();
    }

    if (cameraStream && cameraStream.stop) {
        cameraStream.stop();
    }
    stream = null;
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  /*for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }*/

  while(!(new Date().getTime() - start) > milliseconds);

}

function videoError(e) {
    // do something
    console.log("Unable to get video stream!");
}
</script>


</body>
</html>
