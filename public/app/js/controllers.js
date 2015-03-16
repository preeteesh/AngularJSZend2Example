(function() {
    var as = angular.module('myApp.controllers', []);
    as.controller('AppCtrl', function($scope, $rootScope, $http, $location) {
		
		$scope.activeWhen = function(value) {
            return value ? 'active' : '';
        };
		
        $scope.path = function() {
            return $location.url();
        };
        $rootScope.appUrl = "http://AngularJSZend2Example";

    });

    as.controller('SupplierListCtrl', function($scope, $rootScope, $http, $location) {
        var load = function() {
            console.log('call load()...');
            $http.get($rootScope.appUrl + '/suppliers')
                    .success(function(data, status, headers, config) {
                        $scope.suppliers = data.data;
                        angular.copy($scope.suppliers, $scope.copy);
                    });
        }

        load();

        $scope.addSupplier = function() {
            console.log('call addSupplier');
            $location.path("/new");
        }

        $scope.editSupplier = function(index) {
            console.log('call editSupplier');
            $location.path('/edit/' + $scope.suppliers[index].id);
        }

        $scope.delSupplier = function(index) {
            console.log('call delSupplier');
            var todel = $scope.suppliers[index];
            $http
                    .delete($rootScope.appUrl + '/suppliers/' + todel.id)
                    .success(function(data, status, headers, config) {
                        load();
                    }).error(function(data, status, headers, config) {
            });
        }

    });

    as.controller('NewSupplierCtrl', function($scope, $rootScope, $http, $location) {

        $scope.supplier = {supplier_name: '', addresses: [{address_line_1: '', address_line_2: '', town: '', post_code: '', telephone: '', fax: '', email: ''     }]};
        $scope.saveSupplier = function() {
            console.log('call saveSupplier');
            $http.post($rootScope.appUrl + '/suppliers', $scope.supplier)
                    .success(function(data, status, headers, config) {
                        console.log('success...');
                        $location.path('/suppliers');
                    })
                    .error(function(data, status, headers, config) {
                         console.log('error...');
                    });
        }
        
        $scope.addAddress = function(){
            $scope.supplier.addresses.push({address_line_1: '', address_line_2: '', town: '', post_code: '', telephone: '', fax: '', email: ''     });
        }

        $scope.removeAddress = function(index, supplier){
            supplier.addresses.splice(index, 1);
        };
    });

    as.controller('EditSupplierCtrl', function($scope, $rootScope, $http, $routeParams, $location) {
        $scope.supplier = {};
        
        var load = function() {
            console.log('call load()...');
            $http.get($rootScope.appUrl + '/suppliers/' + $routeParams['id'])
                    .success(function(data, status, headers, config) {
                        $scope.supplier = data;
                        
                        angular.copy($scope.supplier, $scope.copy);
                    });
        };

        load();  

        $scope.updateSupplier = function() {
            console.log('call updateSupplier');

            $http.put($rootScope.appUrl + '/suppliers/' + $scope.supplier.id, $scope.supplier)
                    .success(function(data, status, headers, config) {
                        $location.path('/suppliers');
                    })
                    .error(function(data, status, headers, config) {
                    });
		};
        $scope.addAddress = function(){
            $scope.supplier.addresses.push({address_line_1: '', address_line_2: '', town: '', post_code: '', telephone: '', fax: '', email: ''     });
        }

        $scope.removeAddress = function(index, supplier){
            supplier.addresses.splice(index, 1);
        };
    });
    
    as.controller('SupplierCtrl', function($scope, $rootScope, $http, $routeParams, $location) {
        $scope.supplier = {};
        
        var load = function() {
            console.log('call load()...');
            $http.get($rootScope.appUrl + '/suppliers/' + $routeParams['id'])
                    .success(function(data, status, headers, config) {
                        $scope.supplier = data;
                        angular.copy($scope.supplier, $scope.copy);
                    });
        };

        load();  
    });

}());