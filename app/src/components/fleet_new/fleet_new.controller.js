(function () {
    'use strict';

    angular
        .module('CXMApp')
        .controller('FleetNewCtrl', FleetNewCtrl);

    FleetNewCtrl.$inject = ['$location', 'FleetService'];

    function FleetNewCtrl($location, FleetService) {
        /* jshint validthis: true */
        var vm = this;

        vm.newCar = {};
        vm.addNewCar = addNewCar;
        vm.backToFleet = backToFleet;

        function addNewCar() {
            return FleetService.addNewCar(vm.newCar).then(function (response) {
                vm.newCar = {};
                backToFleet();
            });
        }

        function backToFleet() {
            $location.path('/fleet');
        }
    }
})();