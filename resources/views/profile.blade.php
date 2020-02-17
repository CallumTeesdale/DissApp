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
                <p>Balance: {!! $balance[0] !!}  ST</p>
            </br>
                <h2>email</h2><p>{{Auth::user()->email}}</p>
                <h2>course</h2><p>{{Auth::user()->course}}</p>
                <h2>about you</h2><p>{{Auth::user()->about}}</p>
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
               <a href="{{route('surveys.show',  $survey->id)}}"> View Data</a>
            </ul>
            @endforeach


        </div>
    </div>

</section>
@endsection
