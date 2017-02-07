app.directive('ngFiles', ['$parse', function ($parse) {

    function fn_link(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, { $files: event.target.files });
        });
    };

    return {
        link: fn_link
    }
} ]);


app.controller('MainController', ['$scope','$http', 

function($scope, $http) {
    
    // common http API related directives
    //$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    $http.defaults.headers.post["Content-Type"] = "application/json";
    $http.defaults.headers.post["Accept"] = "application/json";
    //$http.defaults.headers.post["X-API-KEY"] = "41CB86796F3BA";
    $http.crossDomain = true; 
    $http.method = 'POST';
    //$scope.url = "http://cors.io/?u=http://cross/api/v1/bookmystand";
    $scope.url = "http://cross/api/v1/bookmystand";
    
    
    var formdata = new FormData();
            $scope.getTheFiles = function ($files) {
                angular.forEach($files, function (value, key) {
                    formdata.append(key, value);
                });
            };
    
      
    // for fetchallevents API
    $scope.init = function(){
        //console.log("i am here ");        
        $http.post($scope.url + "").success(function(data, status){
            $scope.events = data.events;   
            //console.log($scope.events[0]);
            // need to put all location data into gmap
                       
            var locations = [];
            
            $scope.events.forEach(function(item, index){ 
                var arr = [];
                var event_name = item.name;
                var location_place = item.location.place;
                var location_lat = parseFloat(item.location.lat);   
                var location_lng = parseFloat(item.location.lng);
                var location_zoom = parseFloat(item.location.zoom);
                var event_date = item.whenat;
                var event_id = item.id;
                
                arr.push(event_name, location_place, location_lat, location_lng, location_zoom, event_date, event_id);
                
                locations.push(arr);
                
            });
            //console.log(locations);
            
            mapMarkers(locations);  
                        
            
        }).error(function(data, status){ 
            $scope.status = status;
            console.log(status);
        });
        
    }
    
    $scope.showstands = function(){ 
        event_id = getCookie('event_id');
        
        $http({
                method: "POST",
                url: $scope.url + "/getallstands",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: function(obj) {
                    var str = [];
                    for(var p in obj)
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    return str.join("&");
                },
                data:{event_id:event_id}
            
        }).success (function(data,status,headers,config){                     
             $scope.stands = data;
             //console.log($scope.stands);
            //console.log(data.stands[0].booked);
        }).error(function(data, status, headers, config){
             $scope.status = status;
            console.log(status);
        });
        
    }   
  
        
    // for createuser API
    $scope.reservestand = function(){
        stand_id = getCookie('stand_id');
        
        /*console.log("{\"company_name\":\""+$scope.company_name+"\",\"admin\":\""+$scope.admin+"\",\"admin_email\":\""+$scope.email+"\",\"phone\":\""+$scope.phone+"\",\"add1\":\""+$scope.add1+"\",\"add2\":\""+$scope.add2+"\",\"zip\":\""+$scope.zip+"\", \"stand_id\":\""+stand_id+"\"}");*/
        $http({
                method: "POST",
                url: $scope.url + "/reservestand",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: function(obj) {
                    var str = [];
                    for(var p in obj)
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    return str.join("&");
                },
                data:{"company_name":$scope.company_name,"admin":$scope.admin,"admin_email":$scope.email,"phone":$scope.phone,"add1":$scope.add1,"add2":$scope.add2,"zip":$scope.zip, "stand_id":stand_id}
        }).success (function(data,status,headers,config){                     
             $scope.data = data;
            //console.log(data);
            window.location.href='registration.html'
             
        }).error(function(data, status, headers, config){
             $scope.status = status;
            console.log(status);
        });
        
    }
    
    
    $scope.uploadFiles = function () {

                var request = {
                    method: 'POST',
                    url: '/api/fileupload/',
                    data: formdata,
                    headers: {
                        'Content-Type': undefined
                    }
                };

                // SEND THE FILES.
                $http(request)
                    .success(function (d) {
                        alert(d);
                    })
                    .error(function () {
                    });
            }
		
}]);
