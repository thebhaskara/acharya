/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('kuchbhi', function ($scope) {
    $scope.initDb = function(){
        post({
            action: 'initDb',
            data: null,
            success: function(){
                alert('db initialized');
            },
            error: function(){
                alert('oops!');
            }
        });
    };
    $scope.initQuestionPaperStatus = function(){
        post({
            action: 'initQuestionPaperStatus',
            data: null,
            success: function(){
                alert('db initialized');
            },
            error: function(){
                alert('oops!');
            }
        });
    };
});



