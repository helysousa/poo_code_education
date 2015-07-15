(function() {
        var app = angular.module('listStore',[]);


        app.controller('ListController', [ '$http', function($http){

            var store = this;

            this.clientes = [ ];

            $http({method: 'GET', url:'/index.json.php'}).success(function(data){
               store.clientes = data;
            });

        }]);
    }
)();

