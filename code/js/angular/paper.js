/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

if(Scenarios){
    var blurr = window.onblur;
    var beforeunloadd = window.onbeforeunload;
    var unloadd = window.onunload;
    var keypressss = document.onkeypress;


    onlineExam.controller('paper', function ($scope, $interval) {
        $scope.scenarios = Scenarios;
        $scope.questionNumber = 0;
        $scope.data = {};
        $scope.scenarioData = {};
        $scope.hours = Math.floor(Exam.duration/60);
        $scope.minutes = Exam.duration%60;
        //        $scope.hours = 0;
        //        $scope.minutes = 0;
        $scope.seconds = 0;
        $scope.displayScenario = $scope.scenarios[Object.keys($scope.scenarios)[0]];
        $scope.displayQuestions = $scope.displayScenario.questions;

        window.onblur = function(event){
            $('#warning-focusout').modal();
        }

        window.onbeforeunload = function() {
            return "Your exam would be submitted if you close now. Are you sure?";
        }

        window.onunload = function(){
            $scope.submit();
        }
        document.onkeydown = function(evt) {
            if(evt.ctrlKey)
                console.log('Ctrl\n');

            if(evt.altKey)
                console.log('Alt\n');

            if(evt.shiftKey)
                console.log('Shift\n');

            console.log('key :'+evt.keyCode)
            evt = evt || window.event;
            if (typeof evt.stopPropagation != "undefined") {
                evt.stopPropagation();
            } else {
                evt.cancelBubble = true;
            }
            evt.preventDefault();
        };


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
                    //as.find('.modal-body').text(data);
                    window.onblur=blurr;
                    window.onbeforeunload=beforeunloadd;
                    window.onunload=unloadd;
                    document.onkeydown=keypressss;

                    stopWebCam();
                },
                error: function(data){
                    //alert('Noooo !');
                    console.log(data);
                },
                async: false
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
    });

} else {
    $(document).ready(function(){

        $('#paper-error').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        }).find('button.btn').click(function(){window.close();});;
    });
}

