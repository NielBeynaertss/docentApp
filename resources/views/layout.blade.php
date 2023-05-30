<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <title>@yield('title')</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="https://www.syntra.be/wp-content/uploads/2022/07/Synta-logo-klein.png" alt="logo" height="100px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav navbar-right">
                @foreach($pages as $page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.show', ['name' => strtolower(str_replace(' ', '-', $page->title))]) }}">{{ $page->title }}</a>
                    </li>
                @endforeach
            </ul>                                  
        </div>
    </nav>
    
    
    <div class="container">
        @yield('content')
    </div>


        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-D1X+RTF9/kZdFx2mgZ8X/UKZj2MumJLIVjZ5b0ISxjMK3Jn9cVWgD6yBRe0+/TB" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
