@extends('layouts.app')


@section('content')
<div class="form-wrap">
    <div class="form-container">
        <div class="content-card">
            @foreach ($surveys as $surv)

            <a class="card" href="{{route('response.show', $surv->id)}}">
                <div class="front" style="background-image: url(/storage/categories/{{$surv->category}}.jpg">
                    <p>{{ $surv->survey_title}}</p>
                </div>
                <div class="back">
                    <div>
                        <p>{{$surv->survey_description}}</p>

                        <button class="button">Respond</button>
                    </div>
                </div>
            </a>

            @endforeach

        </div>
        {{ $surveys->links() }}
    </div>
    @endsection
