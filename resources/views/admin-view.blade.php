@extends('layouts.app')

@section('content')

<section class="account-view-wrap">
    <div class="profile-container">
        <div class="profile-data-container">
            <div class="profile-data">
                <h1>menu</h1>
                <a class="link" href="{{route('admin.get.market')}}">View market Items</a>
            </div>
        </div>
        <div class="divider"></div>
        <div class="surveys-container">
            <h1>Options</h1>
           @if (!empty($variables))
           <div class='market-container'>
            @foreach ($variables as $var)

                    <div class="item-container">
                        <div class="market-image"><img src="/storage/market/{{$var->image}}" alt=""></div>
                        <div class="market-details">
                            <h1>{{ $var->name}}</h1>
                            <p>Description: {{$var->description}}</p>
                            <p>Price: {{$var->price}}</p>
                            <p>live: {{$var->live}}</p>
                            <p> Creation Date: {{$var->created_at}}</p>
                            <a href="{{ route('admin.market.edit.item', ['id' => $var->id])}}" class="link"> Edit</a>
                        </div>
                    </div>

            @endforeach
        </div>
           @else
               <p>Choose and option</p>
           @endif
        </div>
    </div>
</section>

@endsection
