onlineExam.directive('myElement', function(){
    return {
        link : function(scope, element, attributes){
            scope.$myElement = element;
        }
    };
});
onlineExam.directive('myAttributes', function(){
    return {
        link : function(scope, element, attributes){
            scope.$myAttributes = attributes;
        }
    };
});
