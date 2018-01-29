@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}">{{ $project_id }}</a><i class="icon-angle-right"></i></li>
        <li class="active">Страницы</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project_id }}/page/add">
            <button type="button" class="btn btn-primary">Новая страница</button>
        </a>
    </div>
            @if (isset($pages))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Страница</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td>{{ $page->pages }}</td>
                            <td class="text-right">
                                <a href="/dashboard/project/{{ $project_id }}/page/{{ $page->id }}">
                                    <button type="button" class="btn btn-primary">Редактировать</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
