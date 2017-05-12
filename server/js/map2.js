/**
 * @author Jonas Tomanga
 */




function initMap() {
    $.getScript("js/markerswithlabels.js");
    if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function (loc) {
	    var center = {lat: loc.coords.latitude, lng: loc.coords.longitude};
	    doMap(center);
	});
    } else {
	var center = {lat: -22.570379, lng: 17.0751573};
	doMap(center);
    }
}
function doMap(center) {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
	center: center,
	zoom: 14
    });

    var image = {
	//url: 'img/robot.png',
	// This marker is 20 pixels wide by 32 pixels high.
	//size: new google.maps.Size(15, 40)
	path: google.maps.SymbolPath.CIRCLE,
	fillColor: 'white',
	fillOpacity: 0.8,
	scale: 15,
	strokeColor: 'gold',
	strokeWeight: 2
    };
    url = "/api/demand";
    $.get(url, function (data) {
	//alert(data);
	if (data.code) {
	    // var markers = [];
	    $.each(data.intersections, function (index, int) {
		loc = {lat: parseFloat(int.Lat), lng: parseFloat(int.Lond)};
		var info = new google.maps.InfoWindow({
		    content: "<div><p><strong>Major Street:</strong> " + int.main_street
			    + "</p><p><strong>Minor Street:</strong> " + int.side_street
			    + "</p><p><strong>Phases: </strong>" + int.phases
			    + "</p><p><strong>Ways:</strong> " + int.ways + "</p>"
			    + "</div>"
		}
		);
		var marker = new MarkerWithLabel({
		    position: loc,
		    map: map,
		    labelContent: "A",
		    icon: image,
		    labelStyle: {color: 'black'}
		});
		/*var marker = new google.maps.Marker({
		 map: map,
		 icon: image,
		 position: loc,
		 title: int.junction_name
		 });*/
		/*var marker = new google.maps.Marker({
		 position: loc,
		 title: int.junction_name

		 });*/
		marker.addListener('click', function () {
		    info.open(map, marker);
		});
		//markers.push(marker);

	    });
	    // var markerCluster = new MarkerClusterer(map, markers);
	}
    }, "json");

}

