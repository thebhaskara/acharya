/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('addOthers', function ($scope,$http) {
    $scope.topics = Topics;
    $scope.selectTopic = function(){
        $scope.parentTopic = this.topic;
        $scope.topictext = this.topic.text;
    };

    $scope.createTopic = function(){
        var data = {
            text: $scope.topicName,
            parentTopicId: $scope.parentTopic && $scope.parentTopic.id ? $scope.parentTopic.id : -1
        };
        post({
            action: 'createtopic',
            data: data,
            success: function(data){
                if(data)
                    $scope.topics = JSON.parse(data);
            },
            error: doNothing
        });
        $scope.resetTopicFields();
    };

    $scope.resetTopicFields = function(){
        $scope.topicName = '';
        $scope.parentTopic = null;
        $scope.topictext = '';

    };

    $scope.createLevel = function(){
        var data = $scope.level;
        post({
            action: 'createlevel',
            data:data,
            success: function(data){},
            error: doNothing
        });
        $scope.resetLevelFields();
    };

    $scope.resetLevelFields = function(){
        $scope.level = null;
    };

    $scope.doNothing = function(){};
});



