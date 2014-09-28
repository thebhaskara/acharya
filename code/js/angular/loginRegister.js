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
                    alert(data);
                }
            },
            error: function(data){
                alert(data);
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
                alert(data);
            },
            error: function(data){
                alert(data);
            }
        });
    }
});


