/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

onlineExam.controller('createPaper', function ($scope) {
    $scope.exams = Exams;
    $scope.candidates = Candidates;
    $scope.paper={
        candidates: []
    };
    $scope.temp={};
    
    $scope.selectExam = function () {
        $scope.paper.selectedExam = this.exam;
        $scope.temp.selectExamText = this.exam.name;
    };
    
    $scope.selectCandidate = function(){
        $scope.temp.selectedCandidate = this.candidate;
        $scope.temp.selectCandidateText = this.candidate.first_name;
    };
    
    $scope.addCandidate = function(){
        if($scope.paper.candidates.contains($scope.temp.selectedCandidate)) return false;
        $scope.paper.candidates.push($scope.temp.selectedCandidate);
    };
    
    $scope.removeCandidate = function(){
        $scope.paper.candidates.remove(this.candidate);
    };
    
    $scope.submit = function(){
        var data = $scope.paper;
        post({
            action: 'createpapers',
            data: data,
            success: function(data){
                try{
                    var d = JSON.parse(data);
                    if(d) {
                        alert('papers are created!');
                        return;
                    }
                } catch(ex) {}
                alert('Noooo !');
            },
            error: function(data){ 
                alert('Noooo!'); 
            }
        });
    };
});



