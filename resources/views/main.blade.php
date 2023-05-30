@extends('layout')

@section('title', 'Main Page')

@section('content')
    <div class="container">

        <div class="row">
            @component('map')
            @endcomponent
        </div>

        <h1>Teachers</h1>

        <div class="row">
            @foreach($teachers as $teacher)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $teacher->lastname }}, {{ $teacher->firstname }}</h5>
                            <h6 class="card-text">Profession: {{ $teacher->description }}</h6>
                            <p class="card-text">Category: {{ $teacher->category->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
