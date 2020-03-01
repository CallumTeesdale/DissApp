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
           <div class='surveys-container'>
            <div class="content-card">
            @foreach ($variables as $var)

            <a class="card" href="{{route('admin.market.edit.item', $var->id)}}">
                <div class="front" style="background-image: url(/storage/market/{{$var->image}});">
                  <p>{{ $var->name}}</p>
                </div>
                <div class="back">
                  <div>
                    <p>{{$var->description}}</p>
                    <p>Price: {{$var->price}} ST</p>
                    <p>Live: {{$var->live}}</p>
                    <p>Date Created: {{$var->created_at}} ST</p>

                    <button class="button">Edit</button>
                  </div>
                </div>
                </a>

            @endforeach
            </div>
        </div>
           @else
               <p>Choose and option</p>
           @endif
        </div>
    </div>
</section>

@endsection
