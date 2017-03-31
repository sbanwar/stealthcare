app.controller('authCtrl', function ($scope, $rootScope, $window, $route, $routeParams, $location, $http, Data) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    var serviceBase = 'api/v1/api.php?request=';

    // restrict SuperAdmin OnLoading 
    $scope.restrictSuperAdminOnLoading = function () {
        Data.get('Session').then(function (results) {
            if (results.UserID) {
                //alert(results.UserAccess);
                if (results.UserAccess == 'ADMIN') {
                    $location.path('organization');
                }
            }
        });
    };

    $scope.loadCurrntActiveClassForauthCtrlSidebarMenu = function (ActiveClass) {
        $rootScope.activeClass = ActiveClass;
    };

    // login request
    $scope.doLogin = function (reqparams) {
        $scope.loading = true;
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams}),
            url: serviceBase+'Login',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            Data.toast(results);
            if (results.status_code == "1") {
                $route.reload(); 
            } else if (results.status_code == "2") {
                $location.path('organization');
            }
            $scope.loading = false;
        })
        .error(function(results){

        });
    };

    // create user request
    //$scope.signup = {email:'',password:'',name:'',phone:'',address:''};
    $scope.signUp = function (reqparams) {
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams}),
            url: serviceBase+'signUp',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            Data.toast(results);
            if (results.status_code == "1") {
                $location.path("");
            }
        })
        .error(function(results){

        });
    };

    // create organizer request
    $scope.createOrgsignUp = function (reqparams) {
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams}),
            url: serviceBase+'createOrgsignUp',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            Data.toast(results);
            if (results.status_code == "1") {
                $location.path('careOrgs');
            }
        })
        .error(function(results){

        });
    };

    $scope.loadCareOrg = function (OrgID) {
        $scope.loading = true;
        $http({
            method: 'post',
            data: $.param({OrgID: OrgID}),
            url: serviceBase+'updateSessionByOrgID',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            $location.path('organization');
            $scope.loading = false;
        });
    };

    // create plan statas request
    $scope.createPlan = function (reqparams) {
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams}),
            url: serviceBase+'createPlan',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            Data.toast(results);
            if (results.status_code == "1") {
                $location.path('license/plans');
            }
        })
        .error(function(results){

        });
    };

    $scope.editPlanload = function () {
        var PlanID = $routeParams.id;
        $scope.loading = true;
        $http({
            method: 'post',
            data: $.param({PlanID: PlanID}),
            url: serviceBase+'getUpdatePlanByID',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            if (results.status_code == "1") {
                $rootScope.resultData = results.response_data;
                $rootScope.Status = results.status_data;
                $scope.loading = false;
            }
        });
    };

    // edit plan statas request
    $scope.updatePlan = function(reqparams){
        $scope.loading = true;
        var PlanID = $routeParams.id;
        var StatusID = angular.element('#StatusID').val();
        //alert(StatusID);
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams,PlanID: PlanID,StatusID: StatusID}),
            url: serviceBase+'getUpdatePlanByID',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            if (results.status_code == "1") {
                Data.toast(results);
                $rootScope.resultData = results.response_data;
                $rootScope.Status = results.status_data;
                $scope.loading = false;
            }
        });
    };

    // delete plan statas request
    $scope.deletePlan = function(index){
        if(confirm("Are you sure to want to delete plan")){
            $scope.loading = true;
            $http({
                method: 'post',
                data: $.param({PlanID: index}),
                url: serviceBase+'deletePlan',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function(results){
                Data.toast(results);
                if (results.status_code == "1") {
                    $route.reload(); 
                }
                $scope.loading = false;
            })
            .error(function(results){

            });
        }
    };

    // change plan statas request
    $scope.changeStatusPlan = function(PlanID,StatusID){
        if(confirm("Are you sure to want to change plan status")){
            $scope.loading = true;
            $http({
                method: 'post',
                data: $.param({PlanID: PlanID,StatusID: StatusID}),
                url: serviceBase+'changeStatusPlan',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function(results){
                Data.toast(results);
                if (results.status_code == "1") {
                    $route.reload(); 
                }
                $scope.loading = false;
            })
            .error(function(results){

            });
        }
    }; 

    // create license request
    $scope.createLicense = function (reqparams) {
        $scope.loading = true;
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams}),
            url: serviceBase+'createLicense',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            Data.toast(results);
            if (results.status_code == "1") {
                $location.path('licenses');
                $scope.loading = false;
            }
        })
    }; 

    $scope.editLicenseload = function () {
        var LicenseID = $routeParams.id;
        $scope.loading = true;
        $http({
            method: 'post',
            data: $.param({LicenseID: LicenseID}),
            url: serviceBase+'getUpdateLicenseByID',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            if (results.status_code == "1") {
                $rootScope.resultData = results.response_data;
                $rootScope.Status = results.status_data;
                $scope.loading = false;
            }
        });
    };

    // edit plan statas request
    $scope.updateLicense = function(reqparams){
        $scope.loading = true;
        var LicenseID = $routeParams.id;
        var StatusID = angular.element('#StatusID').val();
        //alert(StatusID);
        $http({
            method: 'post',
            data: $.param({reqparams: reqparams,LicenseID: LicenseID,StatusID: StatusID}),
            url: serviceBase+'getUpdateLicenseByID',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(results){
            if (results.status_code == "1") {
                Data.toast(results);
                $rootScope.resultData = results.response_data;
                $rootScope.Status = results.status_data;
                $scope.loading = false;
            }
        });
    };

    // delete plan statas request
    $scope.deleteLicense = function(index){
        if(confirm("Are you sure to want to delete License")){
            $scope.loading = true;
            $http({
                method: 'post',
                data: $.param({LicenseID: index}),
                url: serviceBase+'deleteLicense',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .success(function(results){
                Data.toast(results);
                if (results.status_code == "1") {
                    $route.reload(); 
                }
                $scope.loading = false;
            })
            .error(function(results){

            });
        }
    };
    
    /*$scope.LicensePlans = function () {
       $scope.loading = true;
        Data.get('LicensePlans').then(function (results) {
            $scope.UserData = results.response_data;
            Data.toast(results);
            $location.path('license_plans');
            $scope.loading = false;
        });
    }
    $scope.CareOrga = function () {
        $scope.loading = true;
        Data.get('CareOrga').then(function (results) {
            $scope.UserData = results.response_data;
            Data.toast(results);
            $location.path('care_orga');
            $scope.loading = false;
        });
    }*/

    // logout request
    $scope.logout = function () {
        $scope.loading = true;
        Data.get('Logout').then(function (results) {
            Data.toast(results);
            $route.reload(); 
            $scope.loading = false;
        });
    }
});