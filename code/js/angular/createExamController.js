/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('createExam', function ($scope,$http) {
    $scope.topics = Topics;
    $scope.levels = ExperienceLevels;

    $scope.resetFields = function () {
        $scope.exam = {};
        $scope.exam.param = {};
        $scope.temp = {};
    };
    
    $scope.resetFields();

    $scope.selectTopic = function(){
        $scope.temp.selectedTopic = this.topic;
        $scope.exam.param.topictext = this.topic.text;
    };
    

    $scope.selectLevel = function(){
        $scope.temp.selectedLevel = this.level;
        $scope.exam.param.leveltext = this.level.text;        

    };

    $scope.addParameter = function(){
        if(!$scope.exam.parameters)
            $scope.exam.parameters = [];
        $scope.exam.parameters.push({
            questionsCount: $scope.exam.param.questionsCount,
            topic: $scope.temp.selectedTopic,
            level: $scope.temp.selectedLevel
        });
    };
    
    $scope.removeParameter = function(){
        $scope.exam.parameters.remove(this.parameter);
    };
    
    $scope.submit = function(){
        var data = $scope.exam;
        post({
            action: 'createexam',
            data: data,
            success: function(data){
                if(data){
                   alert('great') ;
                }
            }
        });
        $scope.resetFields();
    };
});



