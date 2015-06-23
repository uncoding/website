// 坐标页面处理js
var map;
var marker;
var geocoder;
var zoom = 8;

function initMap() {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(lat, lng);
//	var latlng = new google.maps.LatLng(108.94426900000008, 34.264987);

	
	var options = {
		zoom : zoom,
		center : latlng,
		scrollwheel: false,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("m_canvas"),
			options);

	marker = new google.maps.Marker({
		position : latlng,
		map : map
	});

	google.maps.event.addListener(map, 'zoom_changed', function() {
		zoom = map.getZoom();
		if (zoom == 0) {
			map.setZoom(10);
		}
	});

	google.maps.event.addListener(map, 'click', function(event) {
		showLatLng(event.latLng);
//		refreshLoc(event.latLng);
		marker.setPosition(event.latLng);
       marker.setTitle(results[0].formatted_address);
	});

	fetchAddress(latlng);
//	showLatLng(latlng);
}

function showLatLng(location) {

//	var latlng = new google.maps.LatLng(lat, lng);
	jQuery("#longitude").val(location.lng());
	jQuery("#latitude").val(location.lat());
}

function refreshLoc(location) {
	map.setCenter(location);
}

function fetchAddress(location) {
	if (geocoder) {
		geocoder.geocode({
			'latLng' : location
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					marker.setTitle(results[0].formatted_address);
				}
			}
		});
	}
}
function codeAddress() {
	  var address = document.getElementById("placeName").value;
	  if (geocoder) {
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	      	 showLatLng(results[0].geometry.location);
	        map.setCenter(results[0].geometry.location);
	        marker.setPosition(results[0].geometry.location);
	        marker.setTitle(results[0].formatted_address);
	       
	      } else {
	        alert("地图找不到你所需要的问题。原因：" + status);
	      }
	    });
	  }
	}