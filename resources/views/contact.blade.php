@extends('layouts.app')

@section('content')
<div class="form-wrap">
    <div class="form-container">
        <form class="login-form" action="" method="post">
            <input type="text" name="contact[name]" placeholder="Enter your name" class="username">
            <input type="email" name="contact[email]" placeholder="Enter your email" class="username">
            <input type="textarea" name="contact[enquiry]" placeholder="Enter your enquiry" class="username">
            <input type="submit" value="submit">
        </form>
    </div>
</div>
@endsection
