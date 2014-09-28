/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/
onlineExam.directive('mySummernote', function($parse){
    return {
        link : function(scope, element, attributes){
            // $parse works out how to get the value.
            // This returns a function that returns the result of your ng-model expression.
            var modelGetter = $parse(attributes['mySummernote']);
            //console.log(modelGetter(scope));

            // This returns a function that lets us set the value of the ng-model binding expression:
            var modelSetter = modelGetter.assign;

            // This is how you can use it to set the value 'bar' on the given scope.
            modelSetter(scope, $(element).summernote());

            //console.log(modelGetter(scope));
        }
    };
});

onlineExam.controller('addScenario', function ($scope,$http) {
    $scope.questions = [];
    $scope.topics = Topics;
    $scope.levels = ExperienceLevels;
    $scope.questionTypes = QuestionTypes;

    $scope.init = function(){

    };

    $scope.addQuestion = function(){
        $scope.questions.push({id:$scope.questions.length});
        //applySummernote();
    }

    $scope.addScenario = function(){
        var questions = [];
        for(var i=0; i<$scope.questions.length;i++){
            var question = {};
            question.content = $scope.questions[i].contentDoc.code();
            question.timeLimit = $scope.questions[i].timeLimit;
            question.typeId = $scope.questions[i].type.id;
            question.levelId = $scope.questions[i].level.id;
            question.selTopics = $scope.questions[i].selTopics;
            question.answer1 = $scope.questions[i].answer1;
            question.answer2 = $scope.questions[i].answer2;
            question.answer3 = $scope.questions[i].answer3;
            question.answer4 = $scope.questions[i].answer4;
            question.answer1isright = $scope.questions[i].answer1isright ? true : false;
            question.answer2isright = $scope.questions[i].answer2isright ? true : false;
            question.answer3isright = $scope.questions[i].answer3isright ? true : false;
            question.answer4isright = $scope.questions[i].answer4isright ? true : false;
            questions.push(question);
        }
        var dataAdsds = {
            scenario: {
                content: $scope.contentDoc.code(),
                instructions: $scope.instructions,
                summary: $scope.summary
            },
            questions: questions
        };
        post({
            action: 'createscenario',
            data: dataAdsds,
            success: function(data){
                alert('great');
                window.location.reload();
            },
            error: function(){}
        });
    };

    $scope.removeQuestion = function(){
        $scope.questions.remove(this.question);
    };

    $scope.getTopic = function(id){
        for(var i=0; i<$scope.topics.length;i++){
            if($scope.topics[i].id == id)
                return $scope.topics[i];
        }
    };

    $scope.initQuestion = function(){
        this.question.selectableTopics = $scope.topics.clone();

    };

    $scope.selectLevel = function(){
        this.$parent.question.leveltext = this.level.text;
        this.$parent.question.level = this.level;
    }

    $scope.selectQuestionType = function(){
        this.$parent.question.questionTypeText = this.type.text;
        this.$parent.question.type = this.type;
    }

    $scope.selectTopic = function(){
        this.$parent.question.topictext = this.topic.text;
        this.$parent.question.topic = this.topic;
    }

    $scope.addTopic = function(){
        if(!this.question.selTopics) this.question.selTopics=[];
        if(this.question.selTopics.contains(this.question.topic)) return false;
        this.question.selTopics.push(this.question.topic);
        this.question.topic = null;
        this.question.topictext = '';
    }

    $scope.removeSelTopic = function(){
        this.$parent.question.selTopics.remove(this.selTopic);
    }

});



