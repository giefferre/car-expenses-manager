(function () {
    'use strict';

    angular
        .module('CXMApp')
        .controller('FleetListCtrl', FleetListCtrl);

    FleetListCtrl.$inject = ['FleetService'];

    function FleetListCtrl(FleetService) {
        /* jshint validthis: true */
        var vm = this;

        vm.fleet = [];
        vm.getFleet = getFleet;

        activate();

        function activate() {
            return getFleet();
        }

        function getFleet() {
            return FleetService.getFleet()
                .then(function (response) {
                    vm.fleet = response.data;
                });
        }
    }
})();