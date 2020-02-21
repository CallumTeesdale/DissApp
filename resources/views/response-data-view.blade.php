@extends('layouts.app')


@section('content')
   <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script src="/js/Chart.min.js"></script>


<script src="/css/Chart.min.css"></script>



<script>$(document).ready(function () { $('#dtBasicExample').DataTable({ "pagingType": "simple", "pageLength": 10 }); });</script>

<div class="form-wrap">
    <div class="form-container">
        @if (is_array($charts))
            @foreach ($charts as $r)
                {!! $r !!}
             @endforeach

        @else
             {{$charts}}
        @endif





    </div>
</div>

<script>
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("accordion-show") == -1) {
            x.className += " accordion-show";
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("black", "accordion-active");
        } else {
            x.className = x.className.replace(" accordion-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("accordion-active", "black");
        }
    }
</script>

@endsection
