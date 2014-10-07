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
        $scope.loaderText="Creating papers...";
        $('#loader').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        var data = $scope.paper;
        post({
            action: 'createpapers',
            data: data,
            success: function(data){
                $('#loader').modal('hide');
                try{
                    var d = JSON.parse(data);
                    if(d) {
                        $scope.notification = {
                            title: 'Done',
                            text: 'Creating papers is finished!'
                        }
                        $('#notification').modal({
                            keyboard: false,
                            show: true
                        });
                        return;
                    }
                } catch(ex) {}

                $scope.notification = {
                    title: 'Error',
                    text: 'Response was not clear ' + data
                }
                $('#notification').modal({
                    keyboard: false,
                    show: true
                });
                //alert('Noooo !');
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
    };
});



