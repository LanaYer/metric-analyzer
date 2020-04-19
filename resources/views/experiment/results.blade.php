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

            <h4 class="text-center">Эксперимент {{ $experiment->id }}</h4>

            @if ($config=="")
                CSV файл не найден
            @endif

            <canvas id="canvas"></canvas>

            <script>
                var config = <?php echo $config;?>;

                window.onload = function() {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx, config);
                };
            </script>

        </div>

        <div class="col-md-3 result_page-steps">
            <h5>Этапы</h5>
            @foreach($experiment->steps as $step)
                <div class="result_page-step">
                    <p><span>{{$step->start_at}}</span> - {{$step->description}}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/Chart.js/Chart.bundle.js')}}"></script>
    <script src="{{ asset('js/Chart.js/chartjs-plugin-annotation.js')}}"></script>
    <script src="{{ asset('js/Chart.js/utils.js')}}"></script>
@endsection