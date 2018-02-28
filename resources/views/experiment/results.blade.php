@extends('layouts.app')
<?php
/**
 * @var \App\Models\Project $project
 *
 *
 */
?>
@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}">{{ $project->id  }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}/experiment">Эксперименты</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}/experiment/{{ $experiment->id }}">{{ $experiment->id }}</a></li>
        <li class="active">Результаты</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="col-md-9">

            @if ($config=="")
                CSV файл не найден
            @endif

            <canvas id="canvas"></canvas>

            <script>
                var colors =
                    [
                        'rgb(0, 0, 0)',
                        'rgb(255, 99, 132)', //red
                        'rgb(54, 162, 235)', //blue
                        'rgb(75, 192, 192)', //green
                        'rgb(255, 205, 86)', //yellow
                        'rgb(153, 102, 255)', //purple
                        'rgb(255, 159, 64)', //orange
                        'rgb(201, 203, 207)']; //grey

                var config = <?php echo $config;?>;

                window.onload = function() {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx, config);
                };

                var colorNames = Object.keys(window.chartColors);

            </script>

        </div>

        <div class="col-md-3 result_page-steps">
            <h4>Этапы</h4>
            @foreach($experiment->steps as $step)
                <p><span>{{$step->start_at}}</span> - {{$step->description}}</p>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/Chart.js/Chart.bundle.js')}}"></script>
    <script src="{{ asset('js/Chart.js/chartjs-plugin-annotation.js')}}"></script>
    <script src="{{ asset('js/Chart.js/utils.js')}}"></script>
@endsection