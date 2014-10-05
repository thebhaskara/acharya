/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

$(document).ready(function(){
    //    applySummernote();
});

//function applySummernote(){
//    setTimeout(function(){
//        $(".summernote").destroy();
//        $(".summernote").summernote();
//    }, 100);
//}

function post(options){
    $.ajax({
        type: "POST",
        url: 'ajax.php?a='+options.action,
        contentType: "application/x-www-form-urlencoded",
        data: options.data,
        success: options.success,
        error: options.error,
        async: options.async? options.async: true,
    });
}

function doNothing(){alert("ohh no!!");}

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

Array.prototype.clone = function() {
    var clone = [];
    for(var i=0;i<this.length;i++){
        clone.push(this[i]);
    }
    return clone;
};

Array.prototype.contains = function(obj) {
    for(var i = 0; i < this.length; i++) {
        if (this[i].$$hashKey == obj.$$hashKey) {
            return true;
        }
    }
    return false;
};

function count(obj) {

    if (obj.__count__ !== undefined) { // Old FF
        return obj.__count__;
    }

    if (Object.keys) { // ES5 
        return Object.keys(obj).length;
    }

    // Everything else:

    var c = 0, p;
    for (p in obj) {
        if (obj.hasOwnProperty(p)) {
            c += 1;
        }
    }

    return c;

}


var onlineExam = angular.module('onlineExam', ['ngSanitize']);

//angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives', 'ngSanitize'])

//var ExperienceLevels = [
//    {
//        id: 1,
//        text: 'Beginner'
//    },
//    {
//        id: 2,
//        text: '1yr Exp.'
//    },
//    {
//        id: 3,
//        text: '2yr Exp.'
//    },
//    {
//        id: 4,
//        text: 'Expert'
//    }
//];
var QuestionTypes = [
    {
        id: 1,
        text: 'Multiple choice'
    },
    {
        id: 2,
        text: 'One liner'
    },
    {
        id: 3,
        text: 'Paragraph'
    }
];
//var Topics = [
//    {
//        id: 1,
//        text: 'C#'
//    },
//    {
//        id: 2,
//        text: 'Aptitude'
//    },
//    {
//        id: 3,
//        text: 'Database'
//    },
//    {
//        id: 4,
//        text: 'C++'
//    }
//];

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