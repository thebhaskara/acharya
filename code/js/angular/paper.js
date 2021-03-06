/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

//if(Scenarios){
onlineExam.controller('paper', function ($scope, $interval) {

    var blurr = window.onblur;
    var beforeunloadd = window.onbeforeunload;
    var unloadd = window.onunload;
    var keypressss = document.onkeypress;
    var video = document.querySelector("#videoElement");
    var canvas = document.querySelector('#canvas');
    //var ctx = canvas.getContext('2d');
    var mediaStream = null;

    webcam = {
        start: function(){
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

            window.URL = window.URL || window.webkitURL;

            if (navigator.getUserMedia) {
                navigator.getUserMedia({video: true, audio: true}, webcam.handleStream, webcam.error);
            }

        },
        handleStream:function(stream) {
            video.src = window.URL.createObjectURL(stream);
            mediaStream = stream;

            //$scope.startExam();
            startMonitoring.onblur();
            enableStartExam();
            $scope.examDisabled = false;
            $scope.refresh();
        },
        stop: function() {
            if (video) {
                video.pause();
                video.src = '';
                video.load();
            }
            if (mediaStream && mediaStream.stop) {
                mediaStream.stop();
            }
            stream = null;
        },
        error: function(e) {
//            $('#webcam-error').modal({
//                backdrop: 'static',
//                keyboard: false,
//                show: true
//            }).find('button.btn').click(function(){window.close();});
        },
        snapshot: function () {
            if (mediaStream) {
                canvas.height = video.videoHeight;
                canvas.width = video.videoWidth;
                canvas.getContext('2d').drawImage(video, 0, 0);
                return canvas.toDataURL('image/png');
            }
        }
    }

    startMonitoring = {
        onblur: function(){
            window.onblur = function(event){
                $('#warning-focusout').modal();
            }
        },
        onbeforeunload: function(){
            window.onbeforeunload = function() {
                return "Your exam would be submitted if you continue now. Are you sure?";
            }
        },
        onunload: function(){
            window.onunload = function(){
                $scope.submit();
            }
        },
        onkeydown: function(){
            document.onkeydown = function(evt) {
                evt = evt || window.event;
                if (typeof evt.stopPropagation != "undefined") {
                    evt.stopPropagation();
                } else {
                    evt.cancelBubble = true;
                }
                evt.preventDefault();
            };
        }
    };
    stopMonitoring = {
        onblur: function(){
            window.onblur = blurr;
        },
        onbeforeunload: function(){
            window.onbeforeunload = beforeunloadd;
        },
        onunload: function(){
            window.onunload = unloadd;
        },
        onkeydown: function(){
            document.onkeydown = keypressss
        }
    };

    enableStartExam = function(){
        $scope.examDisabled = false;
    }

    $scope.refresh = function(){
        $scope.$apply(function() {
            $scope.examDisabled = $scope.examDisabled;
        });
    }

    $scope.examDisabled = webcamRequired;
    $scope.examDisabledfn = function(){
        return $scope.examDisabled;
    };
    $scope.isWebCamRequired = webcamRequired;

    $(document).ready(function(){
        if(webcamRequired){
            webcam.start();
        }
        else{
            startMonitoring.onblur();
            //$scope.examDisabled = false;
        }
        $('#instructions').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        }).find('button.btn').click(function(){
            $scope.startExam();
            $('#instructions').modal('hide');
        });

    });

    startMonitoring.onbeforeunload();
    startMonitoring.onkeydown();
    startMonitoring.onunload();

    $scope.scenarios=[];

    $scope.startExam = function(){
        post({
            action: 'loadExam',
            data: { qid: questionPaperId },
            success: function (data){
                var info = JSON.parse(data);
                if(info.scenarios){
                    startApplicaion(info.scenarios, info.Exam);
                } else {
                    paperError();
                }
            },
            error: paperError
        });
    }

    function paperError(){
        $(document).ready(function(){
            $('#paper-error').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            }).find('button.btn').click(function(){window.close();});
        });
    }

    function startApplicaion(actualScenarios, Exam){
        //if(!actualScenarios || !actualScenarios.length || actualScenarios.length<1)
            //return;
        $scope.scenarios = actualScenarios;
        $scope.questionNumber = 0;
        $scope.data = {};
        $scope.scenarioData = {};
        $scope.hours = Math.floor(Exam.duration / 60);
        $scope.minutes = Exam.duration % 60;
        //        $scope.hours = 0;
        //        $scope.minutes = 0;
        $scope.seconds = 0;
        $scope.displayScenario = $scope.scenarios[Object.keys($scope.scenarios)[0]];
        $scope.displayQuestions = $scope.displayScenario.questions;

        timer1 = $interval(function(){
            var data = {
                photo: webcam.snapshot()
            };
            post({
                action: 'saveImage',
                data: data,
                success: function(){},
                error: function(){}
            });
        },5000);

        $scope.initScenario = function(){
            //this.content = $sce.trustAsHtml(this.scenario.scenario_content);
            this.scenario.id = this.scenarioId;
        }

        $scope.submitConfirm = function(){
            $('#submit-confirm').modal();
        }
        $scope.submit = function(){
            $('#submit-confirm').modal('hide');
            $scope.loaderText="Submitting...";
            $('#loader').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $scope.submitted = true;
            var data = $scope.data;
            $interval.cancel(timer);
            $interval.cancel(timer1);
            post({
                data:data,
                action: 'submitExam',
                success: function(data){
                    $scope.results = JSON.parse(data);
                    $('#loader').modal('hide');
                    var resulttt = $('#show-result').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                    if($scope.results.is_passed=='true'){
                        resulttt.find('.text-success').show();
                        resulttt.find('.text-danger').hide();
                    } else {
                        resulttt.find('.text-success').hide();
                        resulttt.find('.text-danger').show();
                    }
                    resulttt.find("#marks-container").text($scope.results.total_marks);

                    stopMonitoring.onbeforeunload();
                    stopMonitoring.onblur();
                    stopMonitoring.onkeydown();
                    stopMonitoring.onunload();

                    webcam.stop();
                },
                error: function(e){
                    //alert('Noooo !');
                    $scope.notification = {
                        title: 'Error',
                        text: e
                    }
                    $('#notification').modal({
                        keyboard: false,
                        show: true
                    });
                }
            });
        };

        $scope.questionInit = function(){
            $scope.data[this.questionId] = "";
            var question = this.question;
            question.number = count($scope.data);
            question.id = this.questionId;
            jQuery.each(question.answers, function(key, val){
                question.answers[key] = {text:val, id:key};
            });
        }

        $scope.scenarioInit = function(){

            $scope.scenarioData[this.scenarioId] = "";
            this.scenario.number = count($scope.scenarioData);
        }

        $scope.changeOption = function(answer){
            $scope.data[this.question.id] = answer;
            $scope.answered(this.question);
        }

        $scope.decreaseOneSec = function(){
            if($scope.submitted ){
                $interval.cancel(timer);
                return;
            }
            if($scope.hours==0 && $scope.minutes==0 && $scope.seconds==0){
                $interval.cancel(timer);
                $interval.cancel(timer1);
                $scope.submit();
                return;
            }
            if($scope.seconds<1){
                $scope.seconds = 60;
                if($scope.minutes<1){
                    $scope.minutes = 60;
                    $scope.hours -=1;
                }
                $scope.minutes -= 1;
            }
            $scope.seconds -= 1;
        };

        timer = $interval($scope.decreaseOneSec,1000);


        $scope.clickScenario = function(){
            $scope.displayScenario = this.scenario;
            if(!$scope.questionsCopied){
                $scope.displayQuestions = this.scenario.questions;
                for(var i=0;i<Object.keys(this.scenario.questions).length;i++){
                    $scope.visited(this.scenario.questions[Object.keys(this.scenario.questions)[i]]);
                }
            }
            $scope.questionsCopied = false;
        };
        $scope.clickQuestion = function(){
            $scope.displayQuestions = [this.question];
            $scope.visited(this.question);
            $scope.questionsCopied = true;
        };

        $scope.visited = function(question, force){
            if(!question.status || force)
                question.status = 'btn-primary';
        };

        $scope.answered = function(question){
            question.status = 'btn-success';
        };

        $scope.removeOption = function( answer){
            if($scope.data[this.question.id] == answer){
                this.answer.given = "";
                $scope.data[this.question.id] = "";
                $scope.visited(this.question, true);
            }
        };
        $scope.reload = function(){
            //window.location.reload();
            $scope.scenarios=[];
            $scope.displayQuestions=[];
            $scope.displayScenario=[];
            Scenarios = [];
            window.close();
        }
    }
});

//} else {
//    $(document).ready(function(){
//
//        $('#paper-error').modal({
//            backdrop: 'static',
//            keyboard: false,
//            show: true
//        }).find('button.btn').click(function(){window.close();});
//    });
//}

