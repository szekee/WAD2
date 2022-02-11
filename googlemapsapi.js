
var locations = [
    ['Bondi Beach', -33.890542, 151.274856, 4],
    ['Coogee Beach', -33.923036, 151.259052, 5],
    ['Cronulla Beach', -34.028249, 151.157507, 3],
    ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
    ['Maroubra Beach', -33.950198, 151.259302, 1]
];


axios
    .get('getLocations.php') // get open job locations from database
    .then((response) => {
        joblocations = response.data;

        initMap()
        infowindow = new google.maps.InfoWindow();

        // get lat and lng from api
        for (joblocation of joblocations) {
            const jobid = joblocation.jobid;
            const jobname = joblocation.jobname;
            addr = joblocation.address;
            url = encodeURI("https://maps.googleapis.com/maps/api/geocode/json");
            param = { address: addr, key: "AIzaSyCGdgfbpfzPWvgFcl3T4Cp5wWalYzbwNKc" };


            // call Google Map API        
            callMapAPI(url, param)
            .then(output => {
                // get lat and lng data
                lat = output.geometry.location.lat;
                lng = output.geometry.location.lng;
                formataddr = output.formatted_address;
    
                // add markers to map
                placeMarker(lat, lng);

                // add click popup 
                let contentString = `
                <div>
                    <h4>${jobname}</h4> 
                    <p>${formataddr}</p>
                    <a style='outline: none;' href="side_bar.php?id=${jobid}">View job</a> 
                </div>
                `;
                popup(map, infowindow, contentString, marker)
                });

            
        }
    })
    .catch((error) => {
        console.log(error.message);
    })

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 1.2975488, lng: 103.8494183}, // user country
    zoom: 11
    });
}

function callMapAPI(url, param) {
    return axios.get(url, { params: param })
    .then((response) => {
        // process response.data object
        output = response.data.results[0];
        return output;
    })
    .catch((error) => {
        // process error object
        console.log(error.message);
        alert("Something went wrong");
    });
}

function placeMarker(lat, lng) {
    marker = new google.maps.Marker({
        position: {lat, lng},
        map: map
    });
}

function popup(map, infowindow, contentString, marker) {
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(contentString);
      infowindow.open(map, marker);
    });
}



