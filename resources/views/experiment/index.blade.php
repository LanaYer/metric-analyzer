@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
        <li class="active">{{ $project_id }}<i class="icon-angle-right"></i></li>
        <li class="active">Эксперименты</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project_id }}/experiment/add">
            <button type="button" class="btn btn-primary">Новый эксперимент</button>
        </a>
    </div>
            @if (isset($experiments))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Страница</th>
                        <th>Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($experiments as $experiment)
                        <tr>
                            <td>{{ $experiment->name }}</td>
                            <td>{{ $experiment->description }}</td>
                            <td>
                                <a href="/dashboard/project/{{ $project_id }}/segment/{{ $experiment->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
