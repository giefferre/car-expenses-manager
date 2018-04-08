(function () {
    'use strict';

    angular
        .module('CXMApp')
        .factory('FleetService', FleetService);

    FleetService.$inject = ['$http'];

    function FleetService($http) {
        var service = {
            getFleet: getFleet,
            addNewCar: addNewCar,
        };

        return service;

        function getFleet() {
            return $http({ method: 'GET', url: '/apimock/fleet.json' }).
                then(function (data, status, headers, config) {
                    return data;
                }, function (data, status, headers, config) {
                    console.log(data);
                    console.log(status);
                });
        }

        function addNewCar(car) {
            return $http({
                method: 'POST',
                url: '/apimock/fleet.json',
                data: car,
            }).then(function (data, status, headers, config) {
                return data;
            }, function (data, status, headers, config) {
                console.log(data);
                console.log(status);
            });
        }
    }
})();