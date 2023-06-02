<!-- resources/views/partials/teacher-list.blade.php -->

@foreach ($teachers as $teacher)
    <div class="col-md-4">
        <div class="card mb-3" style="height: 200px;">
            <div class="card-body">
                <h5 class="card-title">{{ $teacher->firstname }} {{ $teacher->lastname }}</h5>
                <h6 class="card-text">Profession: {{ $teacher->description }}</h6>
                <p class="card-text">Category: {{ $teacher->category->name }}</p>
                <a href="#" class="btn btn-primary contact-btn">Contact</a>
            </div>
        </div>
    </div>
@endforeach

