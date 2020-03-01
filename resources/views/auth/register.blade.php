@extends('layouts.app')

@section('content')
<section class="login-wrap">
    <div class="login-container">
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <br>
                                <input id="username" placeholder="username" type="text" class="username @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <br/>
                                    <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br/>
                                    <input id="password-confirm" placeholder="confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <br/>


                                <input id="email" placeholder="email" type="email" class="email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br/>
                                <input id="dob"  type="date" class="username @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br/>
                                <input name="priv_level" type="hidden" value="0">

                                <input id="course" placeholder="Course" type="text" class="username   @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" required autocomplete="course">

                                @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br />
                                <input id="about" placeholder="About You" type="textarea" class="username   @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" required autocomplete="about">

                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>



                                <button type="submit" class="register">
                                    {{ __('Register') }}
                                </button>
                            </form>

</div>
</section>
@endsection
