@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id }}">{{ $project->id }}</a><i class="icon-angle-right"></i></li>
        <li class="active">Сегменты</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project->id }}/segment/add">
            <button type="button" class="btn btn-primary">Новый сегмент</button>
        </a>
    </div>
            @if (isset($project->segments))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($project->segments as $segment)
                        <tr>
                            <td>{{ $segment->name }}</td>
                            <td class="text-right">
                                <a href="/dashboard/project/{{ $project->id }}/segment/{{ $segment->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
