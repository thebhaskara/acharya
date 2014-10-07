/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('loginRegister', function ($scope) {
    $scope.temp = {
        usertypes: ['Examiner', 'Applicant']
    };
    $scope.login = {};

    $scope.selectUsertype = function(){
        $scope.login.usertype = this.type;
        $scope.temp.usertypetext = this.type;
    };

    $scope.login = function(){
        $scope.loaderText="Loging in...";
        $('#loader').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        var data = $scope.login;
        post({
            action: 'login',
            data: data,
            success: function(data){
                $('#loader').modal('hide');
                var d = JSON.parse(data);
                if(d){
                    window.location.reload();
                } else {

                    $scope.notification = {
                        title: 'Error',
                        text: 'Please check username and password'
                    }
                    $('#notification').modal({
                        keyboard: false,
                        show: true
                    });
                }
            },
            error: function(e){

                $scope.notification = {
                    title: 'Error',
                    text: e.responseText
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
                //alert("Nooo !");
            }
        });

    };

    $scope.selectRegisterUsertype = function(){
        $scope.temp.regusertypetext = this.type;
        $scope.register.ussertype = this.type;
    };

    $scope.register = {};
    $scope.registerSubmit = function(){
        $scope.loaderText="Registering...";
        $('#loader').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        var data = $scope.register;
        post({
            action: 'register',
            data: data,
            success: function(data){
                $('#loader').modal('hide');
                $scope.notification = {
                    title: 'Done',
                    text: 'Registering is finished!'
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
                //alert("Nooo !");
            },
            error: function(e){
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
    }
});


onlineExam.controller('applicant', function ($scope) {
    $scope.history = History;
    $scope.historyHeadings = [];

    if($scope.history.length>0){
        jQuery.each($scope.history[0], function(key, val){
            $scope.historyHeadings.push(key);
        });
    }

    $scope.current = Current;
    $scope.currentHeadings = [];

    if($scope.current.length>0){
        jQuery.each($scope.current[0], function(key, val){
            $scope.currentHeadings.push(key);
        });
    }
});
