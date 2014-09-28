/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('paper', function ($scope) {
    $scope.scenarios = Scenarios;
    $scope.questionNumber = 0;
    $scope.data = {};
    
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
                alert(data);
                console.log(data);
            },
            error: function(data){
                alert(data);
                console.log(data);
            }
        });
    };
    
    $scope.questionInit = function(){
        $scope.data[this.questionId] = "";
    }
    
    $scope.changeOption = function(questionid, answer){
        $scope.data[questionid] = answer;
    }
});



