@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
        <form class="login-form" method="POST" enctype="multipart/form-data"
            action="{{ route('admin.category.post') }}">
            @csrf
            <div class="profile-image">
                <img src="/storage/categories/{{ $category->id ?? ''}}.jpg" />
            </div>
            <br>

            <input type="hidden" name="id" id="id" value="{{ $category->id ?? '' }}">
            <br>
            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name ?? '' }}">
            <br>
            <div class="form-group">
                <input type="file" class="form-control" name="image" id="image" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-center text-muted">Please upload a valid image file. Size of
                    image should
                    not be more than 2MB.</small>
            </div>
            <br>
            <button type="submit" class="register">
                {{__('Create Or Update') }}
            </button>
            <br>


            <a href="{{ route('admin.get.market') }}">
                <button type="button" class="register">
                    {{__('Back') }}
                </button>
            </a>

        </form>
        <form class="login-form" action="{{ route('admin.category.delete', $category->id ?? '' ) }}" method="POST">
            @csrf
            <button type="submit" class="register">
                {{__('Delete') }}
            </button>
        </form>
        </form>
    </div>
</div>

@endsection
