(function () {
    'use strict';

    angular
        .module('CXMApp')
        .controller('ExpenseNewCtrl', ExpenseNewCtrl);

    ExpenseNewCtrl.$inject = ['$location', 'FleetService', 'ExpensesService'];

    function ExpenseNewCtrl($location, FleetService, ExpensesService) {
        /* jshint validthis: true */
        var vm = this;

        vm.newExpense = {};
        vm.fleet = [];
        vm.addNewExpense = addNewExpense;
        vm.backToExpenses = backToExpenses;

        activate()

        function activate() {
            return getFleet();
        }

        function getFleet() {
            return FleetService.getFleet()
                .then(function (response) {
                    vm.fleet = response.data;
                });
        }

        function addNewExpense() {
            return ExpensesService.addNewExpense(vm.newExpense).then(function (response) {
                vm.newExpense = {};
                backToExpenses();
            });
        }

        function backToExpenses() {
            $location.path('/expenses');
        }
    }
})();