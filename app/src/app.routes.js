(function () {
    'use strict';

    angular
        .module('CXMApp')
        .config(routeConfig);

    routeConfig.$inject = ['$routeProvider'];

    function routeConfig($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'src/components/homepage/homepage.html', title: 'homepage' })
            .when('/fleet', { templateUrl: 'src/components/fleet_list/fleet_list.html', title: 'fleet_list' })
            .when('/fleet/new', { templateUrl: 'src/components/fleet_new/fleet_new.html', title: 'fleet_new' })
            .otherwise({ redirectTo: '/' });
    }
})();