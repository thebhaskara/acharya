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
        doAPost({
            action: 'createtopic',
            data: data,
            success: function(data){
                if(data){
                    $scope.topics = JSON.parse(data);
                } else {
                    doNothing();
                }
                $scope.resetTopicFields();
            },
            error: doNothing
        });
    };

    $scope.resetTopicFields = function(){
        $scope.topicName = '';
        $scope.parentTopic = null;
        $scope.topictext = '';

    };

    $scope.createLevel = function(){

        var data = $scope.level;

        doAPost({
            action: 'createlevel',
            data:data,
            success: function(data){
                if(!data){
                    doNothing();
                }
                $scope.resetLevelFields();
            },
            error: doNothing
        });
    };

    $scope.resetLevelFields = function(){
        $scope.level = null;
    };

    $scope.doNothing = function(){};
});



