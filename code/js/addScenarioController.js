/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

var onlineExam = angular.module('onlineExam', []);

onlineExam.controller('addScenario', function ($scope,$http) {
    $scope.questions = [];
    $scope.topics = Topics;
    $scope.levels = ExperienceLevels;
    $scope.questionTypes = QuestionTypes;

    $scope.addQuestion = function(){
        $scope.questions.push({id:$scope.questions.length});
    }

    $scope.addScenario = function(){
        var dataAdsds = {
            scenario: {
                content: $scope.content,
                instructions: $scope.instructions,
                summary: $scope.summary
            },
            questions: $scope.questions
        };
        $.ajax({
            type: "POST",
            url: 'ajax.php',
            contentType: "application/x-www-form-urlencoded",
            data: dataAdsds,
            success: function(){alert('great');}
        });
    }
});