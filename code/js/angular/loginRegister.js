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
        var data = $scope.login;
        post({
            action: 'login',
            data: data,
            success: function(data){
                var d = JSON.parse(data);
                if(d){
                    window.location.reload();
                } else {
                    alert("Nooo !");
                }
            },
            error: function(data){
                alert("Nooo !");
            }
        });

    };

    $scope.selectRegisterUsertype = function(){
        $scope.temp.regusertypetext = this.type;
        $scope.register.ussertype = this.type;
    };

    $scope.register = {};
    $scope.registerSubmit = function(){
        var data = $scope.register;
        post({
            action: 'register',
            data: data,
            success: function(data){
                alert("Nooo !");
            },
            error: function(data){
                alert("Nooo !");
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
    
    $scope.startExam = function(questionPaperId){
        
    }
    
    
});
