@extends('layouts.app')


@section('content')

<script src="/js/Chart.min.js"></script>
<script src="/css/Chart.min.css"></script>
<div class="form-wrap">
    <div class="form-container">
    <canvas id="myChart" width="400" height="400"></canvas>

    @foreach ($responses as $response)
        @php
           $data = \json_decode($response->response);


        @endphp


    @endforeach
    </div>
</div>
@endsection
