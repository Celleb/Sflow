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
    var image = {
	url: 'img/robot.png',
	// This marker is 20 pixels wide by 32 pixels high.
	size: new google.maps.Size(15, 40)
    };
    url = "/api/intersections";
    $.get(url, function (data) {
	//alert(data);
	if (data.code) {
	    $.each(data.intersections, function (index, int) {
		loc = {lat: parseFloat(int.Lat), lng: parseFloat(int.Lond)};
		var info = new google.maps.InfoWindow({
		    content: "<div><p><strong>Major Street:</strong> " + int.main_street
			    + "</p><p><strong>Minor Street:</strong> " + int.side_street
			    + "</p><p><strong>Phases: </strong>" + int.phases
			    + "</p><p><strong>Ways:</strong> " + int.ways + "</p>"
			    + "<p><strong>Status:</strong> " + int.status + "</p>"
			    + "<p class='text-center'><a href='/intersections/view/" + int.junction_id + "'> View</a></p>"
			    + "</div>"
		}
		);
		var marker = new google.maps.Marker({
		    map: map,
		    icon: image,
		    position: loc,
		    title: int.junction_name
		});
		marker.addListener('click', function () {
		    info.open(map, marker);
		});

	    });
	}
    }, "json");


}


