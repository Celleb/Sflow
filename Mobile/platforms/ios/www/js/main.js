//ons.bootstrap()

var app = angular.module('S-Flow', ['onsen']);
app.controller('mapCtrl', function ($scope, $timeout) {

    ons.ready(function () {
        // Adding marker with hold gesture
        console.log("S-flow map is ready!");
        document.getElementById("map").addEventListener("hold", function (e) {
            console.log('hold is detected');
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
                                    ons.notification.alert({
                                        message: desc + ' was added!'
                                    });
                                }
                            });
                            break;
                    }
                }
            });
        });

        // function for locating user //

        $scope.centerOnMe = function (view) {
            $scope.panorama;
            console.log('Locator called');

            navigator.geolocation.getCurrentPosition(function () {
                $scope.map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
            }, function (error) {
                alert('Unable to get location: ' + error.message);
            });
        };
        //-----------------end-------------------//

        //-----------start ----------//

        //Map initialization
        $timeout(function () {

            var latlng = new google.maps.LatLng(-22.5594100, 17.0832300);
            var myOptions = {
                zoom: 17,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            $scope.map = new google.maps.Map(document.getElementById("map"), myOptions);

        }, 100);

        //Delete all Markers
        $scope.deleteAllMarkers = function () {

            if ($scope.markers.length == 0) {
                ons.notification.alert({
                    message: 'There are no markers to delete!!!'
                });
                return;
            }

            for (var i = 0; i < $scope.markers.length; i++) {

                //Remove the marker from Map
                $scope.markers[i].setMap(null);
            }

            //Remove the marker from array.
            $scope.markers.length = 0;
            $scope.markerId = 0;

            ons.notification.alert({
                message: 'All Markers deleted.'
            });
        };



        //Add single Marker
        $scope.addOnClick = function (event) {
            var x = event.gesture.center.pageX;
            var y = event.gesture.center.pageY - 44;
            var point = new google.maps.Point(x, y);
            var coordinates = $scope.overlay.getProjection().fromContainerPixelToLatLng(point);

            var marker = new google.maps.Marker({
                position: coordinates,
                map: $scope.map
            });

            marker.id = $scope.markerId;
            $scope.markerId++;
            $scope.markers.push(marker);


            $timeout(function () {
                //Creation of the listener associated to the Markers click

                google.maps.event.addListener(marker, "click", function (e) {
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


        };
        //-----------end-------------//
    });
});
