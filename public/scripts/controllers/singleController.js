// public/scripts/authController.js

(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('SingleController', SingleController);


    // TODO: Implémenter toutes la logique pour rechercher les saisons, ainsi que tous les épisodes
    // TODO: Implémenter la gestion des profils pour gérer ces épisodes vus ou non.

    function SingleController($scope, $http, $rootScope, cacheService) {
        $scope.serie = cacheService.getData("selected_serie");


        //TODO: Test send request http and get authenticate user ! for authenticate user
        $scope.subscribe = function () {
            $http.get('api/auth/test').then(function (response) {
                console.log(response);
            }, function (response) {
                console.error("big error !");
            });
        }

    }
})();