<section id="location" class="container p0">
    <div class="row">
        <div class="col-md-12">
            <div class="google-maps content">
                <div id="map"></div>
                <script>
                    function initMap() {
                        geocoder = new google.maps.Geocoder();

                        var london = {lat: 54.093409, lng: -2.89479};
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 5,
                            center: london
                        });
                        var geocoder = new google.maps.Geocoder();

                        geocodeAddress(geocoder, map);
                    }

                    function geocodeAddress(geocoder, resultsMap) {
                        var address = decodeURIComponent('{{$event->map_address}}') + ',UK';

                        address = address.replace(/^[,\s]+|[,\s]+$/g, '').replace(/,[,\s]*,/g, ',');

                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status === 'OK') {
                                resultsMap.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: resultsMap,
                                    position: results[0].geometry.location
                                });

                                resultsMap.setZoom(15)
                            }
                        });
                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJ8-z8GaLziXfz_MCnwL0_HLdw2QgnGes&callback=initMap"></script>
            </div>
        </div>
    </div>
</section>
