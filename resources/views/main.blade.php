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

        <div class="row teacher-list">
            @foreach($teachers as $teacher)
                @if($teacher->approved == 1)
                    <div class="col-md-4 mb-3 teacher-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $teacher->lastname }} {{ $teacher->firstname }}</h5>
                                <h6 class="card-text">Profession: {{ $teacher->description }}</h6>
                                <p class="card-text">Category: {{ $teacher->category->name }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row">
            <div class="col-md-12">
                {{ $teachers->links() }}
            </div>
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
        }

        
    </style>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var map;
        var ajaxRequest;
        var plotlist;
        var plotlayers=[];

        // Init Open Street Maps
        function initmap() {
            // set up the map
            map = new L.Map('map');
            var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
            var osm = new L.TileLayer(osmUrl, {minZoom: 2, maxZoom: 19, attribution: osmAttrib});
            map.setView(new L.LatLng(50.640280, 4.666710), 8); // Set initial view to Belgium
            map.addLayer(osm);

            // Add markers for each teacher's city
            @foreach($teachers as $teacher)
                @if($teacher->approved == 1 && $teacher->city && $teacher->city->codecity)
                    var teacherCoords = [{{ $teacher->city->codecity->latitude }}, {{ $teacher->city->codecity->longitude }}];
                    var marker = L.marker(teacherCoords).addTo(map);
                    marker.bindPopup("<b>{{ $teacher->lastname }}, {{ $teacher->firstname }}</b><br>{{ $teacher->city->codecity->name }}").openPopup();
                @endif
            @endforeach
        }
    </script>

    <script>
        $(document).ready(function() {
            // Initialize the map
            initmap();

            // Store all teacher items
            var teacherItems = $('.teacher-item');

            // Search functionality
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                teacherItems.each(function() {
                    var teacherName = $(this).find('.card-title').text().toLowerCase();
                    var teacherDescription = $(this).find('.card-text').text().toLowerCase();
                    var teacherCategory = $(this).find('.card-text').text().toLowerCase();
                    var teacherLocation = $(this).find('.card-text').text().toLowerCase();
                    if (
                        teacherName.indexOf(searchText) !== -1 ||
                        teacherDescription.indexOf(searchText) !== -1 ||
                        teacherCategory.indexOf(searchText) !== -1 ||
                        teacherLocation.indexOf(searchText) !== -1
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });

    </script>
@endsection
