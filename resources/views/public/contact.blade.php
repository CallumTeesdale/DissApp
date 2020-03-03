@extends('layouts.app')

@section('content')
<div class="login-wrap">
    <div class="login-container">
        <form class="login-form" action="" method="post">
            <br>
            <input type="text" name="name" placeholder="Enter your name" class="username form-control">
            <br>
            <input type="email" name="email" placeholder="Enter your email" class="username form-control">
            <br>
            <input type="textarea" name="enquiry" placeholder="Enter your enquiry" class="username form-control">
            <br>
            <button type="submit" class="register" value="submit">Submit</button>

        </form>
    </div>
</div>
@endsection
