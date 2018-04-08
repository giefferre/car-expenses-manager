(function () {
    'use strict';

    angular
        .module('CXMApp')
        .factory('ExpensesService', ExpensesService);

    ExpensesService.$inject = ['$http'];

    function ExpensesService($http) {
        var service = {
            getExpenseList: getExpenseList,
            addNewExpense: addNewExpense,
        };

        return service;

        function getExpenseList() {
            return $http({ method: 'GET', url: '/apimock/expense_list.json' }).
                then(function (data, status, headers, config) {
                    return data;
                }, function (data, status, headers, config) {
                    console.log(data);
                    console.log(status);
                });
        }

        function addNewExpense(expense) {
            return $http({
                method: 'POST',
                url: '/apimock/expense_list.json',
                data: expense,
            }).then(function (data, status, headers, config) {
                return data;
            }, function (data, status, headers, config) {
                console.log(data);
                console.log(status);
            });
        }
    }
})();