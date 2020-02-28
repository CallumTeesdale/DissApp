@extends('layouts.app')

@section('content')
<section class="login-wrap">
    <div class="login-container">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        @csrf

                                <input id="email" type="email" placeholder="enter your email" class="email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>

                                <button type="submit" class="register">
                                    {{ __('Send Password Reset Link') }}
                                </button>

                    </form>
                </div>
            </section>
@endsection
