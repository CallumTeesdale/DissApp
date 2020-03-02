@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<section class="account-view-wrap">
    <div class="profile-container">
        <div class="profile-data-container">
            <div class="profile-data">
                <h1>menu</h1>
                <a class="link" href="{{route('admin.get.market')}}">View market Items</a>
                <a class="link" href="{{route('admin.get.categories')}}">View categories</a>
            </div>
        </div>
        <div class="divider"></div>
        <div class="surveys-container">
            <div class='surveys-container'>
                <div class="content-card">
                    @if (!empty($items))
                    @foreach ($items as $var)
                    <a class="card" href="{{route('admin.market.edit.item', $var->id)}}">
                        <div class="front" style="background-image: url(/storage/{{$storage ?? ''}}/{{$var->image }});">
                            <p>{{ $var->name}}</p>
                        </div>
                        <div class="back">
                            <div>

                                <p>{{$var->description}}</p>
                                <p>Price: {{$var->price}} ST </p>
                                <p>Live: {{$var->live}}</p>
                                <p>Date Created: {{$var->created_at}} ST</p>

                                <button class="button">Edit</button>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    {{$items->links()}}

                    @elseif(!empty($categories))


                    @foreach ($categories as $var)
                    <a class="card" href="{{route('admin.edit.category', $var->id)}}">
                        <div class="front" style="background-image: url(/storage/{{$storage ?? ''}}/{{$var->id}}.jpg">
                            <p>{{ $var->name}}</p>
                        </div>
                        <div class="back">
                            <div>
                                <button class="button">Edit</button>
                            </div>
                        </div>
                    </a>



                    @endforeach
                    {{$categories->links()}}
                    @else
                    <p>Choose an option</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
