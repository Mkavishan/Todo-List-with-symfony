/**
 * Created by miyuru on 9/13/16.
 */
var app = angular.module('todoApp',[]);
app.controller('todoController',function ($scope, $http) {
    $scope.data = {};
    $scope.addTodo = function(todo){
        $scope.data = angular.copy(todo);

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

        $http.post('http://127.0.0.1:8000/todo/add2', $scope.data, config)
            .success(function (data, status, headers, config) {

                $scope.PostDataResponse = data;

                //$scope.PostDataResponse = "sucsess";
            })
            .error(function (data, status, header, config) {
                $scope.ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
            });
        $scope.data = '';

    }

    $http.get("http://127.0.0.1:8000/todo/list")
        .then(function(response) {
            $scope.todos = response.data;
        }, function(response) {
            $scope.todos = "Error";
        });



})