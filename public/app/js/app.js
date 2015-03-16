(function() {

    var
            //the HTTP headers to be used by all requests
            httpHeaders,
            //the message to be shown to the user
            message,
            as = angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives', 'myApp.controllers']);

    as.value('version', '1.0.7');

    as.config(function($routeProvider, $httpProvider) {
        $routeProvider
                .when('/suppliers', {templateUrl: 'partials/suppliers.html', controller: 'SupplierListCtrl'})
                .when('/new', {templateUrl: 'partials/new.html', controller: 'NewSupplierCtrl'})
                .when('/edit/:id', {templateUrl: 'partials/edit.html', controller: 'EditSupplierCtrl'})
                .when('/supplier/:id', {templateUrl: 'partials/supplier.html', controller: 'SupplierCtrl'})
                .otherwise({redirectTo: '/'});
//        $httpProvider.defaults.useXDomain = true;
//        delete $httpProvider.defaults.headers.common["X-Requested-With"];
    });

    as.config(function($httpProvider) {


        //configure $http to catch message responses and show them
        $httpProvider.responseInterceptors.push(
                function($q) {
                    console.log('call response interceptor and set message...');
                    var setMessage = function(response) {
                        //if the response has a text and a type property, it is a message to be shown
                        //console.log('@data'+response.data);
                        if (response.data.message) {
                            message = {
                                text: response.data.message.text,
                                type: response.data.message.type,
                                show: true
                            };
                        }
                    };
                    return function(promise) {
                        return promise.then(
                                //this is called after each successful server request
                                        function(response) {
                                            setMessage(response);
                                            return response;
                                        },
                                        //this is called after each unsuccessful server request
                                                function(response) {
                                                    setMessage(response);
                                                    return $q.reject(response);
                                                }
                                        );
                                    };
                        });
            });

        }());
