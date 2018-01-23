@extends('layouts.app')

@section('breadcrumbs')

@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/{{ $project_id }}/segment/add">
            <button type="button" class="btn btn-primary">Новый сегмент</button>
        </a>
    </div>
            @if (isset($segments))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Страница</th>
                        <th>Дата создания</th>
                        <th>Дата редактирования</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($segments as $segment)
                        <tr>
                            <td>{{ $segment->name }}</td>
                            <td>{{ $segment->pages }}</td>
                            <td>{{ $segment->created_at }}</td>
                            <td>{{ $segment->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@stop
