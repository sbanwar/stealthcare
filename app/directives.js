app.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});

app.directive('passwordMatch', [function () {
    return {
        restrict: 'A',
        scope:true,
        require: 'ngModel',
        link: function (scope, elem , attrs,control) {
            var checker = function () {
 
                //get the value of the first password
                var e1 = scope.$eval(attrs.ngModel); 
 
                //get the value of the other password  
                var e2 = scope.$eval(attrs.passwordMatch);
                if(e2!=null)
                return e1 == e2;
            };
            scope.$watch(checker, function (n) {
 
                //set the form control to valid if both 
                //passwords are the same, else invalid
                control.$setValidity("passwordNoMatch", n);
            });
        }
    };
}]);

app.directive('usernameAvailable', function($http, $timeout, $q, $rootScope) {
    var serviceBase = 'api/v1/api.php?request='; 
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, elm, attr, control) { 
            elm.bind("change", function() {  
                var username = angular.element('#username').val(); 
                $rootScope.checkExists = true;
                $http({
                    method: 'post',
                    data: $.param({username: username}),
                    url: serviceBase+'checkCareOrgEmailOrUsername',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function(results){
                    $rootScope.checkExists = false;
                    if (results.status_code == "1") {
                        control.$setValidity('usernameExists', false); 
                    } else {
                        control.$setValidity('usernameExists', true); 
                    }                       
                });
            });
        }
    } 
});

app.directive('emailAvailable', function($http, $timeout, $q, $rootScope) {
    var serviceBase = 'api/v1/api.php?request='; 
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, elm, attr, control) { 
            elm.bind("change", function() {  
                var email = angular.element('#email').val(); 
                $rootScope.checkExists = true;
                $http({
                    method: 'post',
                    data: $.param({email: email}),
                    url: serviceBase+'checkCareOrgEmailOrUsername',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function(results){
                    $rootScope.checkExists = false;
                    if (results.status_code == "1") {
                        control.$setValidity('emailExists', false); 
                    } else {
                        control.$setValidity('emailExists', true); 
                    }                       
                });
            });
        }
    } 
});