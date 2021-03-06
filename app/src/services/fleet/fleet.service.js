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
            return $http({ method: 'GET', url: 'http://cxm-api.gieffer.re/fleet' }).
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
                url: 'http://cxm-api.gieffer.re/fleet',
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