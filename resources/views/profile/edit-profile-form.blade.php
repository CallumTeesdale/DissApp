@extends('layouts.app')

@section('content')

<section class="login-wrap">
    <div class="login-container">
        <form class="login-form" method="POST" enctype="multipart/form-data" action="{{ route('edit.profile') }}">
            <div class="profile-image">
                <img src="/storage/avatars/{{ $user->avatar }}" />
            </div>
            @csrf
            <br>
            <input id="email" placeholder="email" value="{{$user->email ?? 'email' }}" type="email"
                class="email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br />
            <input id="course" placeholder="course" value="{{$user->course ?? 'Course'}}" type="text"
                class="username   @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}"
                required autocomplete="course">

            @error('course')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <input id="about" placeholder="about" value="{{$user->about ?? 'About'}}" type="textarea"
                class="username   @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" required
                autocomplete="about">

            @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>

            <div class="form-group">
                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should
                    not be more than 2MB.</small>
            </div>

            <button type="submit" class="register">
                {{__('update') }}
            </button>
            <a href="" class="form-text text-muted">Download User Data </a>

        </form>
        <form action="{{ route('profile.delete', Auth::id())}}" method="POST">
            @csrf
            <button type="submit" class="register">
                {{__('Delete Account') }}
            </button>
        </form>

    </div>
</section>
@endsection
