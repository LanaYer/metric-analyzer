@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}">{{ $project_id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}/experiment">Эксперименты</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}/experiment/{{ $experiment_id }}">{{ $experiment_id }}</a></li>
        <li class="active">Результаты</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">

        </div>
    </div>
@endsection
