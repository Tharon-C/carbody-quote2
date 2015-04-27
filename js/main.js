
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

app.controller('iq_make', function($scope) {
    $scope.loadData = function() {
      var request = {};
     jQuery.ajax({
        url: "https://api.edmunds.com/api/vehicle/v2/makes",
        data: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).done(function(result) {
        $scope.result = result;
        $scope.$apply();
      }).fail(function(err) {
        throw err;
      });
    }
  });

app.controller('iq_model', function($scope) {
    $scope.loadData = function() {
      var request = {
        make: angular.element('#MakeForm').scope().request.make,
      }
      jQuery.ajax({
        url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make,
        data: {
          'fmt': "json",
          'api_key': "xj6qew748e36zyuagvwq3tff"
        },
      }).done(function(result) {
        $scope.result = result;
        $scope.$apply();
      }).fail(function(err) {
        throw err;
      });
    }
  });

app.controller('iq_year', function($scope) {
  $scope.loadData = function() {
    var request = {
      make: angular.element('#MakeForm').scope().request.make,
      model: angular.element('#ModelForm').scope().request.model,
    }
    jQuery.ajax({
      url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make + "/" + request.model,
      data: {
        'fmt': "json",
        'api_key': "xj6qew748e36zyuagvwq3tff"
      },
    }).done(function(result) {
      $scope.result = result;
      $scope.$apply();
    }).fail(function(err) {
      throw err;
    });
  }
});

app.controller('iq_style', function($scope) {
  $scope.loadData = function() {
    var request = {
      make: angular.element('#MakeForm').scope().request.make,
      model: angular.element('#ModelForm').scope().request.model,
      year: angular.element('#YearForm').scope().request.year,
    }
    jQuery.ajax({
      url: "https://api.edmunds.com/" + "api/vehicle/v2/" + request.make + "/" + request.model + "/" + request.year,
      data: {
        'fmt': "json",
        'api_key': "xj6qew748e36zyuagvwq3tff"
      },
    }).done(function(result) {
      $scope.result = result;
      $scope.$apply();
    }).fail(function(err) {
      throw err;
    });
  }
});

app.controller('iq_submit', function($scope) {
    var show = $scope.show_it = function(selected) { 
        return  selected;
    };
});