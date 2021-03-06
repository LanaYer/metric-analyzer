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
        <li><a href="/dashboard/project/{{ $project->id }}">{{ $project->id }}</a><i class="icon-angle-right"></i></li>
        <li class="active">Эксперименты</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project->id }}/experiment/add">
            <button type="button" class="btn btn-primary">Новый эксперимент</button>
        </a>
    </div>
            @if (isset($project->experiments))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($project->experiments as $experiment)
                        @if($experiment->is_active)
                            <tr class="bg-success">
                        @else
                            <tr>
                        @endif
                            <td>{{ $experiment->name }}</td>
                            <td>{{ $experiment->description }}</td>
                            <td class="text-right">
                                <a href="/dashboard/project/{{ $project->id }}/experiment/{{ $experiment->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                            <td class="text-right table-button">
                                 <a href="/dashboard/project/{{ $project->id }}/experiment/{{ $experiment->id }}/step">
                                     <button type="button" class="btn btn-primary">Этапы</button>
                                 </a>
                            </td>
                            <td class="text-right table-button">
                                <a href="/dashboard/project/{{ $project->id }}/experiment/{{ $experiment->id }}/results">
                                    <button type="button" class="btn btn-primary">Результаты</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
