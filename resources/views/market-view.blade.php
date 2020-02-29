@extends('layouts.app')

@section('content')

<div class="form-wrap">
    <div class="form-container">
        <input type="text" name="search" id="search" class="username">
        <div class='market-container'>

            @foreach ($variables as $var)

                    <div class="item-container">
                        <div class="market-image"><img src="/storage/market/{{$var->image}}" alt=""></div>
                        <div class="market-details">
                            <h1>{{ $var->name}}</h1>
                            <p>Description: {{$var->description}}</p>
                            <p>Price: {{$var->price}} ST</p>
                            <a href=""><button class="register">Buy</button></a>
                        </div>
                    </div>

            @endforeach
        </div>

    </div>
</div>
@endsection
