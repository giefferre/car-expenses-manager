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
            return $http({ method: 'GET', url: 'http://cxm-api.gieffer.re/expenses' }).
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
                url: 'http://cxm-api.gieffer.re/expenses',
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