@extends('layouts.app')

@section('content')
<section class="login-wrap">
    <div class="login-container">
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                                <input id="username" placeholder="username" type="text" class="username @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br />
                                <input id="password" placeholder="password" type="password" class="password @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                    <br />
                            <div class="form-buttons">
                                <button type="submit" class="signin">
                                    {{ __('Login') }}
                                </button>
                                <button type="button" class="register" onClick="location.href='{{route('register')}}'"><span>REGISTER</span></button>
                                @if (Route::has('password.request'))
                                    <a class="link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                    </form>
                </div>
</section>
</div>
@endsection
