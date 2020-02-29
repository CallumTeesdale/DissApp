@extends('layouts.app')

@section('content')

<div class="form-wrap">
    <div class="form-container">
        @if (Auth::user()->priv_level === 1)
            <h1>Admin Panel<h1>
        @else
        <h1>Market</h1>
        @endif

    </div>
</div>
@endsection
