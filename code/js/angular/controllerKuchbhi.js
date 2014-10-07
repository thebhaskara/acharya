/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('kuchbhi', function ($scope) {
    $scope.initDb = function(){

        $scope.loaderText="initializing DB...";
        $('#loader').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        post({
            action: 'initDb',
            data: null,
            success: function(){

                $('#loader').modal('hide');
                $scope.notification = {
                    title: 'Done',
                    text: 'Initializing db is finished!'
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
                //alert('db initialized');
            },
            error: function(e){

                $('#loader').modal('hide');
                $scope.notification = {
                    title: 'Error',
                    text: e.responseText
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
            }
        });
    };
    $scope.initQuestionPaperStatus = function(){

        $scope.loaderText="initializing question paper status...";
        $('#loader').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        post({
            action: 'initQuestionPaperStatus',
            data: null,
            success: function(){
                $('#loader').modal('hide');
                $scope.notification = {
                    title: 'Done',
                    text: 'Initializing question paper status is finished!'
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
                //alert('db initialized');
            },
            error: function(e){

                $('#loader').modal('hide');
                $scope.notification = {
                    title: 'Error',
                    text: e.responseText
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
            }
        });
    };
});



