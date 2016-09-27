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

        //$scope.data = '';
        window.location.href = "http://127.0.0.1:8000/todo/index";

    }

    $http.get("http://127.0.0.1:8000/todo/undoneList")
        .then(function(response) {
            $scope.todos = response.data;
        }, function(response) {
            $scope.todos = "Error";
        });


    $scope.changeStatus = function (id) {
        $scope.id = id;
        $scope.id = {
            'id'    :   $scope.id
        }

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        $http.post('http://127.0.0.1:8000/todo/update', $scope.id, config)
            .success(function (data, status, headers, config) {

                $scope.PostDataResponse = data;

                //$scope.PostDataResponse = "sucsess";
            })

    }

    $http.get("http://127.0.0.1:8000/todo/doneList")
        .then(function(response) {
            $scope.dones = response.data;
        }, function(response) {
            $scope.todos = "Error";
        });

    $scope.todo = {};
    $scope.todo.priority = "2";

    $scope.todo.priorities = [{
        id: "1",
        status: "Low"
    }, {
        id: "2",
        status: "Normal"
    }, {
        id: "3",
        status: "High"
    }];



})
