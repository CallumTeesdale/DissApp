@extends('layouts.app')
@section('content')
<div class="form-wrap">
    <div class="form-container">
            <div class="content-card">
                @foreach ($variables as $var)
                @if ($var->live === 1)



            <a class="card" href="{{route('market.buy', $var->id)}}">
            <div class="front" style="background-image: url(/storage/market/{{$var->image}});">
              <p>{{ $var->name}}</p>
            </div>
            <div class="back">
              <div>
                <p>{{$var->description}}</p>
                <p>Price: {{$var->price}} ST</p>
                <button class="button">Buy</button>
              </div>
            </div>
            </a>
            @endif

            @endforeach
    </div>
    </div>

</div>

@endsection
