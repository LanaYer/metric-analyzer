@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}">Проект {{ $project->id  }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}/experiment">Эксперимент {{ $experiment->id }}</a><i class="icon-angle-right"></i></li>
        <li class="active">Этапы</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project->id  }}/experiment/{{ $experiment->id }}/step/add">
            <button type="button" class="btn btn-primary">Новый этап</button>
        </a>
    </div>
            @if (isset($experiment->steps))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Описание</th>
                        <th>Дата начала</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($experiment->steps as $step)
                        <tr>
                            <td>{{ $step->description }}</td>
                            <td>{{ $step->start_at }}</td>
                            <td class="text-right">
                                <a href="/dashboard/project/{{ $project->id  }}/experiment/{{ $experiment->id }}/step/{{ $step->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
