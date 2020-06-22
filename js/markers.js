var customLabel = {
    0: {
      label: {
        color: 'blue',
        fontWeight: 'bold',
        //text: '●',
        fontSize: 'small',
      }             
    },
    1: {
      label: {
        color: 'yellow',
        fontWeight: 'bold',
        //text: '●',
        fontSize: 'small',   
           
      }         
    },
    2: {
      label: {
        color: 'red',
        fontWeight: 'bold',
        //text: '●',
        fontSize: 'small',
      }             
    },
    3: {
      label: {
        color: 'black',
        fontWeight: 'bold',
        //text: '●',
        fontSize: 'small',
      }             
    },
    bar: {
      label: 'B'
    }
  };      
  
    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(-25.388688, -51.460237),
      zoom: 7
    });
    
    var imageIcones = ['http://localhost/bmpr/images/markers/blue_MarkerO.png', 
                       'http://localhost/bmpr/images/markers/yellow_MarkerO.png', 
                       'http://localhost/bmpr/images/markers/red_MarkerO.png', 
                       'http://localhost/bmpr/images/markers/black_MarkerO.png'
                       ];                

    var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP or XML file
      downloadUrl('resultado.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var afastado = markerElem.getAttribute('afastado');
          var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));

          var infowincontent = document.createElement('div');
          var strong = document.createElement('strong');
          strong.textContent = name
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));                
           
          var text = document.createElement('text');
          text.textContent = address
          infowincontent.appendChild(text);
          infowincontent.appendChild(document.createElement('br'));
          var text = document.createElement('text');
          text.textContent = 'Afastado %:'+ afastado
          infowincontent.appendChild(text);              
          var icon = customLabel[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label,
            icon: imageIcones[type] || {} //imageAzul                
          });

          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        });
      });
    }

  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}