@extends('layouts.app')


@section('content')

<script src="/js/Chart.min.js"></script>

<script src="/js/jquery.min.js"></script>
<script src="/css/Chart.min.css"></script>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="/mdb/css/bootstrap.min.css">


<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="/mdb/js/addons/datatables.min.js"></script>


<div class="form-wrap">
    <div class="form-container">
        @foreach ($charts as $r)
            {!! $r !!}
        @endforeach



    </div>
</div>

{{-- <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script> --}}
@endsection
