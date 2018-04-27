@extends('dashboard.project.layout')
    @section('sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Projects LIVE Monitoring</h2>
                        <div class="actions"  style="width:150px">
                            {{--<button type="button" id="change-status" class="btn btn-primary waves-effect pull-right" data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                                {{--Open in full screen--}}
                            {{--</button>--}}
                        </div>
                    </div>

                    <div class="card-block">
                        <div id='map' style='width: 100%; height: 500px;'></div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@push('styles')
    <style>

    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/lodash.min.js') }}"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
    <script>
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {lat: 9.443478, lng: 9.257244}
            });

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            // var markers = _.forEach(locations, function(value){
            //     console.log(value);
            // });
            var markers = locations.map(function(location, i) {
                var infowindow = new google.maps.InfoWindow({
                    content: constructInfoWindow(location)
                });
                var  marker = new google.maps.Marker({
                    position: {lng: location.lng, lat: location.lat},
                    title: location.title
                });
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
                return marker;
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        console.log({!! json_encode($projects_locations) !!});
        var locations = {!! json_encode($projects_locations) !!};

        function constructInfoWindow(payload){
            return '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h1 id="firstHeading" class="firstHeading">'+payload.title+'</h1>'+
                '<div id="bodyContent">'+
                '<p><b>'+payload.details+'</b>, '+payload.description+'</p>'+
                '<p>Project Type: '+payload.project_type+
                '(<b>'+payload.status+'</b>).</p>'+
                '</div>'+
                '</div>';
        }

    </script>
@endpush