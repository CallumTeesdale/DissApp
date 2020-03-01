@extends('layouts.app')

@section('content')
<section class="login-wrap">
    <div class="login-container">
        <p>  Please confirm your password to complete your purchase</p>
        <form class="login-form" method="POST" action="{{ route('market.purchase') }}">
            @csrf
            <input type="hidden" value="{{$id}}"name="id">
            <br>
            <input type="password" name="password" id="password" placeholder="password">
            <br>
            <button type="submit" class="register">
                {{__('Purchase') }}
            </button>

        </form>

    </div>
</section>

@endsection
