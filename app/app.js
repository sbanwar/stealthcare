'use strict';
var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster', 'datatables', 'angularUtils.directives.dirPagination']);

app.config(['$locationProvider','$routeProvider', function($locationProvider, $routeProvider) {
        $locationProvider.html5Mode(true);
        $routeProvider. 
            // FOR SUPERADMIN PORTAL START
            when('/', {
                title: 'Home',
                templateUrl: 'partials/home.html',
                controller: 'authCtrl'
            })
            .when('/logout', {
                title: 'Logout',
                templateUrl: 'partials/login.html',
                controller: 'logoutCtrl'
            })
            .when('/signup', {
                title: 'Signup',
                templateUrl: 'partials/signup.html',
                controller: 'authCtrl'
            })
            /*.when('/dashboard', {
                title: 'Dashboard',
                templateUrl: 'partials/dashboard.html',
                controller: 'authCtrl'
            })*/
            .when('/careOrgs', {
                title: 'Care Organizer',
                templateUrl: 'partials/care_orga.html',
                controller: 'authCtrl'
            })
            .when('/careOrg/create', {
                title: 'Create Care Organizer',
                templateUrl: 'partials/create_care_orga.html',
                controller: 'authCtrl'
            })
            .when('/licenses', {
                title: 'Licenses',
                templateUrl: 'partials/licenses.html',
                controller: 'authCtrl'
            })
            .when('/license/create', {
                title: 'Create License',
                templateUrl: 'partials/create_license.html',
                controller: 'authCtrl'
            })
            .when('/license/edit/:id', {
                title: 'Update License',
                templateUrl: 'partials/update_license.html',
                controller: 'authCtrl'
            })
            .when('/license/plans', {
                title: 'License Plans',
                templateUrl: 'partials/license_plans.html',
                controller: 'authCtrl'
            })
            .when('/license/plan/create', {
                title: 'Create Plan',
                templateUrl: 'partials/create_plan.html',
                controller: 'authCtrl'
            })
            .when('/license_plan/edit/:id', {
                title: 'Update Plan',
                templateUrl: 'partials/update_plan.html',
                controller: 'authCtrl'
            })
            /*.when('/', {
                title: 'blank',
                templateUrl: 'partials/blank.html',
                controller: 'authCtrl'
            })*/  
            // FOR SUPERADMIN PORTAL END

            // FOR ADMIN PORTAL START
            .when('/organization', {
                title: 'Organization Dashboard',
                templateUrl: 'partials/careOrg/dashboard.html',
                controller: 'orgCtrl'
            })
            .when('/organization/client/registration', {
                title: 'Organization Dashboard',
                templateUrl: 'partials/careOrg/client/registration.html',
                controller: 'orgCtrl'
            })
            .when('/organization/client/create', {
                title: 'Create Client',
                templateUrl: 'partials/careOrg/client/add_client.html',
                controller: 'orgCtrl'
            })
            .when('/organization/clients', {
                title: 'Clients',
                templateUrl: 'partials/careOrg/client/clients.html',
                controller: 'orgCtrl'
            })
            // FOR ADMIN PORTAL END
            .otherwise({
                title: 'Page Not Found',
                templateUrl: 'partials/includes/pagenotfound.html',
                controller: 'authCtrl',
            });
}])
.run(function ($rootScope, $route, $location, Data) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {
        $rootScope.baseUrl = 'http://localhost/SCPProject/';
        $rootScope.authenticated = false;
        $rootScope.loading = true;
        $rootScope.onlyNumbers = /^\d+$/;
        Data.get('Session').then(function (results) {
            if (results.UserID) {
                $rootScope.authenticated = true;
                $rootScope.UserID = results.UserID;
                $rootScope.UserName = results.UserName;
                $rootScope.EmailID = results.EmailID;
                $rootScope.UserAccess = results.UserAccess;
                var nextUrl = next.$$route.originalPath;
                //alert(nextUrl);
                if (nextUrl == '/') {
                    if (results.UserAccess == 'ADMIN') {
                        $location.path('organization');
                        $rootScope.loading = false;
                    } else {
                        $location.path("");
                        $rootScope.loading = false;
                    }
                } else if (nextUrl == '/careOrgs') {
                    Data.get('CareOrga').then(function (results) {
                        $rootScope.UserData = results.response_data;
                        Data.toast(results);
                        $rootScope.loading = false;
                    });
                } else if (nextUrl == '/license/plans') {
                    Data.get('LicensePlans').then(function (results) {
                        $rootScope.LicensePlans = results.response_data;
                        Data.toast(results);
                        $rootScope.loading = false;
                    });
                } else if (nextUrl == '/licenses') {
                    Data.get('Licenses').then(function (results) {
                        Data.toast(results);
                        $rootScope.Licenses = results.response_data;
                        $rootScope.loading = false;
                    });
                } else {
                    $rootScope.loading = false;
                }
                //alert(nextUrl);
            } else {
                $rootScope.UserID = '';
                var nextUrl = next.$$route.originalPath;
                if (nextUrl == '/signup' || nextUrl == '/') {

                } else {
                    $location.path("");
                }
                $rootScope.loading = false;
            }
        });
    });
});

app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});