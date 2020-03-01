@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<div class="form-wrap">
    <div class="form-container">
        <form class="login-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.market.post.item') }}">
            @csrf
            <div class="profile-image">
                <img  src="/storage/market/{{ $item->image ?? 'item.jpg'}}" />
            </div>
            <br>
            <input type="hidden" value="{{ $item->id ?? '' }}" name="id">
            <input id="name" value="{{ $item->name ?? '' }}" placeholder="Item Name" type="text" class="form-control-text" name="name" required autocomplete="name">

            <br>
            <input id="description" value="{{ $item->description ?? '' }}" placeholder="Item description" type="text" class="form-control-text" name="description"  required autocomplete="description">
            <input id="price" value="{{ $item->price ?? '' }}" placeholder="Item price" type="number" class="form-control-number" name="price" required autocomplete="price">
            <input type='hidden' value='0' name='live'>
            <input id="live" type="checkbox"  @if (!empty($item) && $item->live ===1)
                checked


            @endif value="1" name="live" class="form-control-checkbox">
            <input id="barcode" value="{{ $item->barcode ?? '' }}" placeholder="Item barcode" type="text" class="form-control-text" name="barcode"  required autocomplete="barcode">
            <br>
            <div class="form-group">
                <input type="file" class="form-control-file" name="image" id="avatarFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
            </div>
            <button type="submit" class="register">
                {{__('Create Or Update') }}
            </button>
            <a href="{{ route('admin.get.market') }}">
            <button type="button" class="register">
                {{__('Back') }}
            </button>
            </a>

        </form>
    </div>
</div>
@endsection
