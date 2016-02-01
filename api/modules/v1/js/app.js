var app = angular.module('myApp', ['ui.bootstrap', 'ngResource']);

app.service('dataService', ['$http', function($http){
    return $http.get('http://it.two.com/api/v1/students?expand=studentsCourses');
}]);

app.controller('index', ['$scope', 'dataService', function($scope, dataService){

    dataService.success(function(data){
        $scope.students = data;
        $scope.total = $scope.students.length;

            //sorting
            $scope.sort = 'name';
            $scope.reverse = false;

            //pagination
            $scope.currentPage = 1;
            $scope.numPerPage = 5;

            $scope.paginate = function (value) {
                var begin, end, index;
                begin = ($scope.currentPage - 1) * $scope.numPerPage;
                end = begin + $scope.numPerPage;
                index = $scope.students.indexOf(value);
                return (begin <= index && index < end);
            };
    });
}]);
