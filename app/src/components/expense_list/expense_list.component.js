(function () {
    'use strict';

    angular
        .module('CXMApp')
        .controller('ExpenseListCtrl', ExpenseListCtrl);

    ExpenseListCtrl.$inject = ['ExpensesService'];

    function ExpenseListCtrl(ExpensesService) {
        /* jshint validthis: true */
        var vm = this;

        vm.expenseListResult = null;
        vm.getExpenseList = getExpenseList;

        activate();

        function activate() {
            return getExpenseList();
        }

        function getExpenseList() {
            return ExpensesService.getExpenseList()
                .then(function (response) {
                    vm.expenseListResult = response.data;
                });
        }
    }
})();