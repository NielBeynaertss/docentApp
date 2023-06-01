<!-- resources/views/partials/teacher-list.blade.php -->
@foreach($teachers as $teacher)
    @if($teacher->approved == 1)
        <div class="col-md-4 teacher-item">
            <div class="card mb-3" style="height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $teacher->lastname }} {{ $teacher->firstname }}</h5>
                    <h6 class="card-text">Profession: {{ $teacher->description }}</h6>
                    <p class="card-text">Category: {{ $teacher->category->name }}</p>
                </div>
            </div>
        </div>
    @endif
@endforeach
