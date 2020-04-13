@extends('layouts.app')

@section('content')
<section class="account-view-wrap">
    <div class="profile-container">
        <div class="profile-data-container">
            <div class="profile-data">
                <h1>menu</h1>
                <a class="link" href="{{route('admin.market.create.item')}}">Create Market Item</a>
                <a class="link" href="{{route('admin.get.market')}}">View market Items</a>

                <a class="link" href="{{route('admin.create.categories')}}">Create Category</a>
                <a class="link" href="{{route('admin.get.categories')}}">View categories</a>
            </div>
        </div>
        <div class="divider"></div>
        <div class="surveys-container">

            @if (!empty($items))
            <div class="content-card half-width">
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
                            <p>Barcodes Left: {{$barcodes[$var->id]}} </p>
                            <p>Date Created: {{$var->created_at}} ST</p>

                            <button class="button">Edit</button>
                        </div>
                    </div>
                </a>

                @endforeach
            </div>
            {{$items->links()}}
            @elseif(!empty($categories))

            <div class="content-card">
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
            </div>
            {{$categories->links()}}
            @else
            <p>Choose an option</p>
            @endif
        </div>

    </div>
    </div>
</section>

@endsection
