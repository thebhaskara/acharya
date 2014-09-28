/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('dropdownController', function($scope){
    $scope.openClass = false;
    $scope.openDropdown = function(){
        $scope.openClass = true;
    }
    $scope.closeDropdown = function(){
        $scope.openClass = false;
    }
    $scope.toggleDropdown = function(){
        $scope.openClass = !$scope.openClass;
    }
});