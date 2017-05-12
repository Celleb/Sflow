//ons.bootstrap()

var app = angular.module('S-Flow', ['onsen']);
app.controller('mapCtrl', function ($scope, $timeout) {

    ons.ready(function () {
        console.log("S-flow map is ready!");
        $scope.Markers = [];
        $scope.marker;
        //Map initialization
        var latlng = new google.maps.LatLng(-22.5594100, 17.0832300);
        var myOptions = {
            zoom: 17,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        $scope.map = new google.maps.Map(document.getElementById("map"), myOptions);
        $scope.overlay = new google.maps.OverlayView();
        $scope.overlay.draw = function () { }; // empty function required
        $scope.overlay.setMap($scope.map);
        // Adding marker with hold gesture
        document.getElementById("map").addEventListener("hold", function (event) {
            ons.notification.confirm({
                message: 'Do you want to add a marker here?',
                callback: function (idx) {
                    switch (idx) {
                        case 0:
                            ons.notification.alert({
                                message: 'Cancelled!'
                            });
                            break;
                        case 1:
                            ons.notification.prompt({
                                message: "Enter Description",
                                callback: function (desc) {
                                    var marker = new google.maps.Marker({
                                        position: event.latLng,
                                        map: $scope.map,
                                        title: desc
                                    });
                                    marker.setMap($scope.map);
                                    marker.id = $scope.markerId;
                                    $scope.markerId++;
                                    $scope.Markers.push(marker);
                                }
                            });
                            break;
                    }
                }
            });


            $timeout(function () {
                //Creation of the listener associated to the Markers click

                google.maps.event.addListener($scope.marker, "click", function (e) {
                    ons.notification.confirm({
                        message: 'Do you want to delete the marker?',
                        callback: function (idx) {
                            switch (idx) {
                                case 0:
                                    ons.notification.alert({
                                        message: 'You pressed "Cancel".'
                                    });
                                    break;
                                case 1:
                                    for (var i = 0; i < $scope.markers.length; i++) {
                                        if ($scope.markers[i].id == marker.id) {
                                            //Remove the marker from Map
                                            $scope.markers[i].setMap(null);

                                            //Remove the marker from array.
                                            $scope.markers.splice(i, 1);
                                        }
                                    }
                                    ons.notification.alert({
                                        message: 'Marker deleted.'
                                    });
                                    break;
                            }
                        }
                    });
                });
            }, 1000);
        });

        //-----------------END---------------------//

        // function for locating user
        $scope.centerOnMe = function (view) {
            $scope.markMe;

            console.log('Locator called');

            navigator.geolocation.getCurrentPosition(function (pos) {
                $scope.map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
                $scope.markMe = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude)
                var marker = new google.maps.Marker({
                    position: $scope.markMe,
                    map: $scope.map,
                    animation: google.maps.Animation.DROP,
                    title: 'My Location'
                });
                marker.setMap($scope.map);
            }, function (error) {
                alert('Unable to get location: ' + error.message);
            });
        };
        //-----------------end------------------//
    });
});
