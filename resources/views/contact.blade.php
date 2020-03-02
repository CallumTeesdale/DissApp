@extends('layouts.app')

@section('content')
<div class="login-wrap">
    <div class="login-container">
        <form class="login-form" action="" method="post">
            <br>
            <input type="text" name="contact[name]" placeholder="Enter your name" class="username">
            <br>
            <input type="email" name="contact[email]" placeholder="Enter your email" class="username">
            <br>
            <input type="textarea" name="contact[enquiry]" placeholder="Enter your enquiry" class="username">
            <br>
            <button type="submit" class="register" value="submit">Submit</button>

        </form>
    </div>
</div>
@endsection
