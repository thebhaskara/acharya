/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

//window.onblur = function(event){
//    //alert('you are trying to move out');
//    
//    //return false;
//    //return true;
//}
//
//window.onbeforeunload = function() {
//    
//    return "You have attempted to leave this page. Are you sure?";
//}
//
//window.onunload = function(){
//    alert('asdf');
//}

onlineExam.controller('paper', function ($scope, $interval) {
    $scope.scenarios = Scenarios;
    $scope.questionNumber = 0;
    $scope.data = {};
    $scope.scenarioData = {};
    $scope.hours = 0;
    $scope.minutes = 1;
    $scope.seconds = 5;
    $scope.displayScenario = $scope.scenarios[Object.keys($scope.scenarios)[0]];
    $scope.displayQuestions = $scope.displayScenario.questions;

    $scope.initScenario = function(){
        //this.content = $sce.trustAsHtml(this.scenario.scenario_content);
        this.scenario.id = this.scenarioId;
    }

    $scope.submit = function(){
        var data = $scope.data;
        post({
            data:data,
            action: 'submitExam',
            success: function(data){
                alert('great !');
                console.log(data);
            },
            error: function(data){
                alert('Noooo !');
                console.log(data);
            }
        });
    };

    $scope.questionInit = function(){
        $scope.data[this.questionId] = "";
        this.question.number = count($scope.data);
    }

    $scope.scenarioInit = function(){

        $scope.scenarioData[this.scenarioId] = "";
        this.scenario.number = count($scope.scenarioData);
    }

    $scope.changeOption = function(questionid, answer){
        $scope.data[questionid] = answer;
        $scope.answered(this.question);
    }

    $scope.decreaseOneSec = function(){
        if($scope.hours==0 && $scope.minutes==0 && $scope.seconds==0){
            $interval.cancel(timer);
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

    $scope.removeOption = function(questionid, answer){
        if($scope.data[questionid] == answer){
            this.answer.given = "";
            $scope.data[questionid] = "";
            $scope.visited(this.question, true);
        }
    };
});



