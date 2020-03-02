@extends('layouts.app')

@section('content')

<div class="form-wrap">
    <div class="form-container">
        <h1>{{ $title ?? ''}}</h1>
        <p>{{ $message ?? '' }}</p>
    </div>
</div>
@endsection
