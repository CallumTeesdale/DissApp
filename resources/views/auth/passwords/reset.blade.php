@extends('layouts.app')

@section('content')
<section class="login-wrap">
    <div class="login-container">
                    <form class="login-form" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                                <input id="email" type="email" placeholder="enter your emails" class="email @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br/>

                                <input id="password" type="password" placeholder="enter password" class="password @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br/>
                                <input id="password-confirm" placeholder="confirm password" type="password" class="password" name="password_confirmation" required autocomplete="new-password">
                                <br/>
                                <button type="submit" class="register">
                                    {{ __('Reset Password') }}
                                </button>
                            </form>
            </div>
        </section>
@endsection
