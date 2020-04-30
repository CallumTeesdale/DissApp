@extends('layouts.app')
@section('content')
<?php

// $date = new DateTime($_SESSION['dob']);
// $now = new DateTime();
// $interval = $now->diff($date);

?>
<script src="/js/jquery.min.js"></script>
<!-- Login form-->
<section class="account-view-wrap">
    <div class="profile-container">
        <div class="profile-data-container">
            <div class="profile-data">
                <div class="profile-image"><img src="/storage/avatars/{{ Auth::user()->avatar }}" alt="avatar"></div>
                <h1>Hello, {{Auth::user()->username}}</h1>
                <p>Balance: {!! $balance[0] !!} ST</p>
                </br>
                <h2>email</h2>
                <p>{{Auth::user()->email}}</p>
                <h2>course</h2>
                <p>{{Auth::user()->course}}</p>
                <h2>about you</h2>
                <p>{{Auth::user()->about}}</p>
                <a class="link" href="{{ route('surveys.create')}}">
                    <p>Create A Survey</p>
                </a>
                @if (Auth::user()->priv_level === 1)
                <a class="link" href="{{ route('admin')}}">
                    <p>Admin</p>
                </a>


                @endif
                <a href="{{route('logout')}}" class="link"
                    onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                <a class="link" href="{{ route('edit.profile') }}">
                    <p>Edit Account</p>
                </a>
                <form id="logout" action="{{route('logout')}}" method="POST" style="display:none"> {{csrf_field() }}
                </form>
            </div>
        </div>
        <div class="divider"></div>
        <div class="surveys-container">
            <h1>Your Surveys</h1>

            @foreach ($surveys as $survey)
            <button data-text-swap="{{$survey->survey_title}}  ▼ " data-text-original="{{$survey->survey_title}} ▶ "
                onclick="myFunction('{{$survey->id}}')" id="button{{$survey->id}}" name="button"
                class="g-button block bl">{{$survey->survey_title}} ▶ </button>
            <div id="{{$survey->id}}" class="hide accordion-container">
                <div class="response-count" style="float:left;">
                    <p>{{$responses_count[$survey->id]}}</p>
                    <p>Responses</p>
                </div>
                <div class="survey_description" style="float:right;">
                    <p>{{$survey->survey_description}}</p>
                </div>


                <a href="{{route('surveys.show',  $survey->id)}}" style="min-width:75%; margin:10px;"> <button
                        class="btn-primary" style="width:100%;">
                        View
                        Data </button></a>
                <a href="{{route('surveys.destroy',  $survey->id)}}" style="min-width:20%;margin:10px;"> <button
                        class="btn-danger" style="width:100%">
                        Delete
                    </button></a>
            </div>
            @endforeach



        </div>
    </div>
</section>
<script>
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("accordion-show-profile") == -1) {
            x.className += " accordion-show-profile";
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("black", "accordion-active");
        } else {
            x.className = x.className.replace(" accordion-show-profile", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("accordion-active", "black");
        }
    }

</script>
@foreach ($surveys as $survey)
<script>
    $("#button{{$survey->id}}").on("click", function() {
  var el = $(this);
  el.text() == el.data("text-swap")
    ? el.text(el.data("text-original"))
    : el.text(el.data("text-swap"));
});


</script>
@endforeach
@endsection
