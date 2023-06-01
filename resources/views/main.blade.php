@extends('layout')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <div id="map"></div>

        <h1>Teachers</h1>

        <div class="row">
            <div class="col-md-12 mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="teacher-list">
                    <div class="row">
                        @include('partials.teacher-list', ['teachers' => $teachers])
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                {{ $teachers->links() }} <!-- Display pagination links -->
            </div>
        </div>

    </div>

    <style>
        body {
            margin: 0;
        }

        #map {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
        }

        .teacher-list {
            height: 400px; /* Set the desired height of the teacher list */
            overflow-y: scroll; /* Enable vertical scrolling */
            overflow-x: hidden; /* Hide horizontal scrolling */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            var map;

            // Init Open Street Maps
            function initmap() {
                // Set up the map
                map = new L.Map('map');
                var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
                var osm = new L.TileLayer(osmUrl, {minZoom: 2, maxZoom: 19, attribution: osmAttrib});
                map.setView(new L.LatLng(50.640280, 4.666710), 8); // Set initial view to Belgium
                map.addLayer(osm);
            }

            // Update map markers
            function updateMarkers(teachers) {
                // Remove existing markers
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                // Add markers for each teacher's city
                teachers.forEach(function(teacher) {
                    if (teacher.codecity) {
                        // Geocode the city name to retrieve latitude and longitude
                        geocodeCity(teacher.codecity, function(result) {
                            if (result && result.length > 0) {
                                var cityLat = result[0].lat;
                                var cityLng = result[0].lon;
                                var teacherCoords = [cityLat, cityLng];
                                var marker = L.marker(teacherCoords).addTo(map);
                                marker.bindPopup(teacher.lastname + ' - ' + teacher.codecity);
                            }
                        });
                    }
                });
            }

            // Geocode city name to retrieve coordinates
            function geocodeCity(city, callback) {
                var geocodeUrl = 'https://nominatim.openstreetmap.org/search';
                var params = {
                    q: city,
                    format: 'json',
                    limit: 1
                };
                $.ajax({
                    url: geocodeUrl,
                    method: 'GET',
                    data: params,
                    success: function(result) {
                        callback(result);
                    },
                    error: function() {
                        callback(null);
                    }
                });
            }

            // Load initial teachers
            loadTeachers({{ $teachers->currentPage() }}); // Pass the current page number from the server-side code

            // Search functionality
            $('#searchInput').on('input', function() {
                loadTeachers(1);
            });

            // Load teachers via AJAX
            function loadTeachers(page) {
                var searchText = $('#searchInput').val();
                $.ajax({
                    url: '{{ route("teachers.filter") }}',
                    method: 'GET',
                    data: {
                        search: searchText,
                        page: page // Pass the current page number
                    },
                    success: function(response) {
                        $('.teacher-list .row').html(response);
                        var teachers = @json($teachers->items()); // Convert the teachers to JavaScript object
                        updateMarkers(teachers); // Update map markers after loading new teachers
                    }
                });
            }

            // Initialize the map
            initmap();
        });
    </script>
@endsection
