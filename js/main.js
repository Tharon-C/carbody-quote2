
  var app = angular.module('app', ['ngSanitize', 'ui.utils', 'ngAnimate', 'cgBusy' ]);
  app.controller('page', function($scope) {
    $scope.request = {};
    $scope.loadSectionData = function(section) {
      angular.element('#' + section).scope().loadData();
    }
  });

app.controller('iq_lookup', function($scope) {
  $scope.loadData = function() {
  }
});

app.controller('iq_make', function($scope, $http) {
    $scope.loadData = function() {
      var request = {};
     $scope.spinner = $http({
        url: "https://api.edmunds.com/api/vehicle/v2/makes",
        method: 'GET',
        params: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).success(function(result) {
        $scope.result = result;
       
      }).error(function(data, status, headers, config) {
        console.log(data);
      });
    }
  });

app.controller('iq_model', function($scope, $http) {
    $scope.loadData = function() {
      var request = {
        make: angular.element('#MakeForm').scope().request.make,
      }
      $scope.spinner = $http({
        url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make,
        method: 'GET',
        params: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).success(function(result) {
        $scope.result = result;
      }).error(function(data, status, headers, config) {
        console.log(data);
      });
    }
  });

app.controller('iq_year', function($scope, $http) {
  $scope.loadData = function() {
    var request = {
      make: angular.element('#MakeForm').scope().request.make,
      model: angular.element('#ModelForm').scope().request.model,
    }
     $scope.spinner = $http({
      url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make + "/" + request.model,
      method: 'GET',
        params: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).success(function(result) {
        $scope.result = result;
      }).error(function(data, status, headers, config) {
        console.log(data); 
      });
  }
});

app.controller('iq_style', function($scope, $http) {
  $scope.loadData = function() {
    var request = {
      make: angular.element('#MakeForm').scope().request.make,
      model: angular.element('#ModelForm').scope().request.model,
      year: angular.element('#YearForm').scope().request.year,
    }
    $scope.spinner = $http({
      url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make + "/" + request.model + "/" + request.year,
      method: 'GET',
        params: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).success(function(result) {
        $scope.result = result;
      }).error(function(data, status, headers, config) {
        console.log(data);
      });
  }
});

app.controller('iq_submit', function($scope) {
    var show = $scope.show_it = function(selected) { 
        return  selected;
    };
});