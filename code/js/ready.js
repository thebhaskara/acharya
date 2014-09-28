/*jslint browser: true, devel: true, sloppy: true, todo: true*/
/*global $, angular, helper*/

$(document).ready(function(){
    //    applySummernote();
});

//function applySummernote(){
//    setTimeout(function(){
//        $(".summernote").destroy();
//        $(".summernote").summernote();
//    }, 100);
//}

function post(options){
    $.ajax({
        type: "POST",
        url: 'ajax.php?a='+options.action,
        contentType: "application/x-www-form-urlencoded",
        data: options.data,
        success: options.success,
        error: options.error
    });
}

function doNothing(){alert("ohh no!!");}

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

Array.prototype.clone = function() {
    var clone = [];
    for(var i=0;i<this.length;i++){
        clone.push(this[i]);
    }
    return clone;
};

Array.prototype.contains = function(obj) {
    for(var i = 0; i < this.length; i++) {
        if (this[i].$$hashKey == obj.$$hashKey) {
            return true;
        }
    }
    return false;
};

function count(obj) {

    if (obj.__count__ !== undefined) { // Old FF
        return obj.__count__;
    }

    if (Object.keys) { // ES5 
        return Object.keys(obj).length;
    }

    // Everything else:

    var c = 0, p;
    for (p in obj) {
        if (obj.hasOwnProperty(p)) {
            c += 1;
        }
    }

    return c;

}

var onlineExam = angular.module('onlineExam', ['ngSanitize']);

//angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives', 'ngSanitize'])

//var ExperienceLevels = [
//    {
//        id: 1,
//        text: 'Beginner'
//    },
//    {
//        id: 2,
//        text: '1yr Exp.'
//    },
//    {
//        id: 3,
//        text: '2yr Exp.'
//    },
//    {
//        id: 4,
//        text: 'Expert'
//    }
//];
var QuestionTypes = [
    {
        id: 1,
        text: 'Multiple choice'
    },
    {
        id: 2,
        text: 'One liner'
    },
    {
        id: 3,
        text: 'Paragraph'
    }
];
//var Topics = [
//    {
//        id: 1,
//        text: 'C#'
//    },
//    {
//        id: 2,
//        text: 'Aptitude'
//    },
//    {
//        id: 3,
//        text: 'Database'
//    },
//    {
//        id: 4,
//        text: 'C++'
//    }
//];