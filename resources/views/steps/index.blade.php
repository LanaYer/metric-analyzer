@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}">{{ $project_id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}/experiment">Эксперимент {{ $experiment_id }}</a><i class="icon-angle-right"></i></li>
        <li class="active">Этапы</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project_id }}/experiment/{{ $experiment_id }}/step/add">
            <button type="button" class="btn btn-primary">Новый этап</button>
        </a>
    </div>
            @if (isset($steps))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Описание</th>
                        <th>Дата начала</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($steps as $step)
                        <tr>
                            <td>{{ $step->description }}</td>
                            <td>{{ $step->start_at }}</td>
                            <td class="text-right">
                                <a href="/dashboard/project/{{ $project_id }}/experiment/{{ $experiment_id }}/step/{{ $step->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
