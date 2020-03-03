@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
        <form class="login-form" method="POST" enctype="multipart/form-data"
            action="{{ route('admin.market.post.item') }}">
            @csrf
            <div class="profile-image">
                <img src="/storage/market/{{ $item->image ?? 'item.jpg'}}" />
            </div>
            <br>
            <input type="hidden" value="{{ $item->id ?? '' }}" name="id">
            <input id="name" value="{{ $item->name ?? '' }}" placeholder="Item Name" type="text" class="form-control"
                name="name" required autocomplete="name">

            <br>
            <input id="description" value="{{ $item->description ?? '' }}" placeholder="Item description" type="text"
                class="form-control" name="description" required autocomplete="description">
            <input id="price" value="{{ $item->price ?? '' }}" placeholder="Item price" type="number"
                class="form-control" name="price" required autocomplete="price">
            <input type='hidden' value='0' name='live'>
            <div class="form-inline">
                <label for="live" class="col-sm-2">Live</label>
                <div class="col-lg-4">
                    <input id="live" class="form-control" type="checkbox" @if (!empty($item) && $item->live ===1)
                    checked


                    @endif value="1" name="live" class="form-control-checkbox">
                </div>
            </div>
            <br>
            <div class="form-group">
                <input type="file" class="form-control" name="image" id="avatarFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-center text-muted">Please upload a valid image file. Size of
                    image should
                    not be more than 2MB.</small>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="barcodes" id="barcodes" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-center text-muted">Please upload a valid csv file</small>
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
        <form class="login-form" action="{{ route('admin.market.item.delete', $item->id ?? '' ) }}" method="POST">
            @csrf
            <button type="submit" class="register">
                {{__('Delete') }}
            </button>
        </form>
    </div>
</div>
@endsection
