@extends('layouts.app')
@section('content')
<?php

// $date = new DateTime($_SESSION['dob']);
// $now = new DateTime();
// $interval = $now->diff($date);

?>
    <!-- Login form-->
<section class="account-view-wrap">
    <div class="profile-container">
        <div class="profile-data-container">
            <div class="profile-data">
                <div class="profile-image"><img src="" alt=""></div>
                <h1>Hello, {{Auth::user()->username}}</h1>
                <p>Balance:  ST</p>
                <p></p>
                <p>{{Auth::user()->email}}</p>
                <a class="link" href="{{ route('surveys.create')}}"><p>Create A survey</p>
                <a href="{{route('logout')}}" class="link" onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                <form id="logout" action="{{route('logout')}}" method="POST" style="display:none"> {{csrf_field() }} </form>
            </div>
        </div>
        <div class="divider"></div>
        <div class="surveys-container">
            <h1>Your Surveys</h1>
            @foreach ($surveys as $survey)
            <ul>
               <li> <p>{{$survey->survey_title}}</p></li>
               <p>{{$survey->survey_description}}</p>
            </ul>
            @endforeach


        </div>
    </div>

</section>
@endsection
