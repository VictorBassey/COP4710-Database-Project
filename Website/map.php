<?php
session_start();
include '../Navbar/navbar.php';
?>
<!DOCTYPE html >
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>Event Map Viewer</title>
	<style>
		#map 
		{
			height: 500px;
			width: 100%;
		}
		body
		{
			background:url('http://clevertechie.com/img/bnet-bg.jpg') #0f2439 no-repeat center top;
		}
		   
		h1
		{
			text-align: center;
			color: white;
		}
		   
	</style>
</head>
<body>
	<h1>View Events</h1>
    <div id="map"></div>

    <script>
	
		//Describes the label based on event type
		var customLabel = 
	    {
			Public: 
			{
				label: 'Pub'
			},
			Private: 
			{
				label: 'Priv'
			},
			
			RSO: 
			{
				label: 'RSO'
			}
        };

		//Starts the map
        function initMap() 
		{
			//Start position of map
			var map = new google.maps.Map(document.getElementById('map'), 
			{
				center: new google.maps.LatLng(28.600574, -81.197687),
				zoom: 12
			});
			var infoWindow = new google.maps.InfoWindow;

			//Calls the PHP file where the event data is kept
		
          
            downloadUrl('http://localhost/COP4710-Database-Project/Website/Output.php', function(data) 
			{
				var xml = data.responseXML;
				var markers = xml.documentElement.getElementsByTagName('marker');
				
				//Sorts the marker information for each XML node
				Array.prototype.forEach.call(markers, function(markerElem) 
				{
				
					//Retrieves event information and sets them to variables
					var description = markerElem.getAttribute('description');
					var location = markerElem.getAttribute('location');
					var eventtype = markerElem.getAttribute('eventtype');
					var venuetype = markerElem.getAttribute('venuetype');
					var point = new google.maps.LatLng
					(
						parseFloat(markerElem.getAttribute('lat')),
						parseFloat(markerElem.getAttribute('lng'))
					);

					//Info window content
					var infowincontent = document.createElement('div');
					var strong = document.createElement('strong');
					strong.textContent = description
					infowincontent.appendChild(strong);
					infowincontent.appendChild(document.createElement('br'));
					
				
					var text = document.createElement('text');
					//May be possible to include a link to the event page here
					text.textContent = 	venuetype			
					infowincontent.appendChild(text);

					//Sets the icon to its appropriate event type
					var icon = customLabel[eventtype] || {};
					
					//Sets the marker's location and label
					var marker = new google.maps.Marker(
					{
						map: map,
						position: point,
						label: icon.label
					});
					
					//Opens the info window when the marker is clicked on
					marker.addListener('click', function() 
					{
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, marker);
					});
				});
			});
        }


		//Converts the XML 
        function downloadUrl(url, callback) 
		{
			var request = window.ActiveXObject ?
			new ActiveXObject('Microsoft.XMLHTTP') :
			new XMLHttpRequest;

			request.onreadystatechange = function() 
			{
				if (request.readyState == 4) 
				{
					request.onreadystatechange = doNothing;
					callback(request, request.status);
			    }
			};

			request.open('GET', url, true);
			request.send(null);
        }

        function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAh2e0Lhk2yflJBOITqe9xgyQ8w_ztEkdg &callback=initMap">
    </script>
</body>
</html>