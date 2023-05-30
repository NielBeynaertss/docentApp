@extends('layout')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <div id="map"></div>

        <h1>Teachers</h1>

        <div class="row">
            @foreach($teachers as $teacher)
                @if($teacher->approved == 1)
                    <div class="col-md-4 mb-3">
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

        window.onload = function() {
            initmap();
        };
    </script>
@endsection
