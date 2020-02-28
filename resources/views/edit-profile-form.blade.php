@extends('layouts.app')

@section('content')

<section class="login-wrap">
    <div class="login-container">
                    <form class="login-form" method="POST" action="{{ route('edit.profile') }}">
                        @csrf
                                <input id="email" value="{{$user->email ?? 'email' }}" type="email" class="email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br/>

                                <input id="course" value="{{$user->course ?? 'Course'}}" type="text" class="username   @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" required autocomplete="course">

                                @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br />
                                <input id="about" value="{{$user->about ?? 'About'}}" type="textarea" class="username   @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" required autocomplete="about">

                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <button type="submit" class="register">
                                    {{__('update') }}
                                </button>
                            </form>

</div>
</section>
@endsection
