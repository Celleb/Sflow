/**
 * @author Jonas Tomanga
 */

var windhoekCordinates = {lat: -22.570379, lng: 17.0751573};
function initMap() {
    var myLatLng = {lat: -25.363, lng: 131.044};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
	center: windhoekCordinates,
	zoom: 14
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
	map: map,
	position: windhoekCordinates,
	title: 'Windhoek!'
    });
}


