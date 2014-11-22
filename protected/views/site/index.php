<div class="header" style="position:absolute;opacity:0.5"></div>
<div id="map_canvas" class="gmaps"></div>
<style>
	.gmaps{
		width:100%;
	    height:100%;
	    margin:0;
	    padding:0;
	    position:absolute;
	}
	#searchFor{

	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
	$(document).ready(function(){
		var mapOptions = {
	      zoom: 18,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		navigator.geolocation.getCurrentPosition(function(position) {
		    var pos = new google.maps.LatLng(position.coords.latitude,
		                                     position.coords.longitude);
		      $lat = position.coords.latitude;
			  $lng = position.coords.longitude;
		      map.setCenter(pos);
		      var marker = new google.maps.Marker({
		        position: pos,
		        map: map,
		        draggable:false
		      });

		}, function() {
		    alert('Map not loaded.');
		});
	});
	$(window).resize(function(){
		pos = new google.maps.LatLng($lat,$lng);
		var mapOptions = {
	      zoom : 18,
	      center : pos
	    };

	    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	    var marker = new google.maps.Marker({
	        position: pos,
	        map: map,
	        draggable:false
	      });
	});
</script>