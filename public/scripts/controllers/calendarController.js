/**
 * Created by Theo.ZIMMERMANN on 07.06.2016.
 */

// public/scripts/calendarController.js

(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('CalendarController', CalendarController);


    function CalendarController($scope, $location, featuredService, cacheService) {
        featuredService.getFeaturedSeries().then(function (response) {
            $scope.featuredSeries = response.featuredseries;
        });

        $scope.detail = function (serie) {
            cacheService.setCache("selected_serie", serie);
            $location.path("/single");
        };
        $scope.options = {
            weekOffset: 1,
            daysOfTheWeek: ['ZO', 'MA', 'DI', 'WO', 'DO', 'VR', 'ZA'],
            constraints: {
                startDate: moment().subtract(1, 'months').format('YYYY-MM-15'),
                endDate: moment().add(2, 'months').format('YYYY-MM-15')
            }
        };
        $scope.events = [
            {date: moment().add(3, 'days').format(), title: "Happy days"},
            {date: moment().subtract(5, 'days').format(), title: "Good old days"},
            {date: moment().subtract(5, 'days').format(), title: "And some more"}
        ];
        $scope.showEvents = function (events) {
            alert(events.map(function (e) {
                return e.title
            }).join("\n"));
        };
    console.log("pouet");
    }

})();