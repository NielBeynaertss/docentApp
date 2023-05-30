@extends('layout')

@section('title', 'Registration')

@section('content')
    <div class="row justify-content-center mt-2 mb-2">
        <div class="row justify-content-center mt-2 mb-2">
            <div class="col-md-8">
        
                <div class="card">
                    <div class="card-header text-center">Registreer als leerkracht</div>
                    <div class="card-body">
                        <form action="{{ route('store') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Naam</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-end text-start">Voornaam</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}">
                                    @if ($errors->has('firstname'))
                                        <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                                <div class="col-md-6">
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start">Beroep</label>
                                <div class="col-md-6">
                                  <input type="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="remarks" class="col-md-4 col-form-label text-md-end text-start">Beschrijving</label>
                                <div class="col-md-6">
                                  <input type="remarks" class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" value="{{ old('remarks') }}">
                                    @if ($errors->has('remarks'))
                                        <span class="text-danger">{{ $errors->first('remarks') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone" class="col-md-4 col-form-label text-md-end text-start">Telefoon</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="website" class="col-md-4 col-form-label text-md-end text-start">Website</label>
                                <div class="col-md-6">
                                  <input type="website" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}">
                                    @if ($errors->has('website'))
                                        <span class="text-danger">{{ $errors->first('website') }}</span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <label for="location" class="col-md-4 col-form-label text-md-end text-start">location</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="location" id="location">
                                        @foreach ($locations as $location)
                                        <option value="{{$location->id }}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <label for="category" class="col-md-4 col-form-label text-md-end text-start">category</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="category" id="location">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id }}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <label for="streetnr" class="col-md-4 col-form-label text-md-end text-start">Straat + nummer</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('streetnr') is-invalid @enderror" id="streetnr" name="streetnr" value="{{ old('streetnr') }}">
                                    @if ($errors->has('streetnr'))
                                        <span class="text-danger">{{ $errors->first('streetnr') }}</span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <label for="codecity" class="col-md-4 col-form-label text-md-end text-start">Postcode + gemeente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('codecity') is-invalid @enderror" id="codecity" name="codecity" value="{{ old('codecity') }}">
                                    @if ($errors->has('codecity'))
                                        <span class="text-danger">{{ $errors->first('codecity') }}</span>
                                    @endif
                                </div>
                            </div>
        
        
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                            </div> 
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection
