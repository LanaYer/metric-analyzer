@section('breadcrumbs')
    <ul class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> Dashboard</li>
    </ul>
@stop

@section('content')
    <div class="dashboard-new">
        <a href="/dashboard/project/add"><button type="button" class="btn btn-primary">Новый проект</button></a>
    </div>
            @if (isset($projects))
                    @foreach ($projects as $project)
                        <div class="col-md-4">
                            @if ($project->is_active)
                                <div class="project-block active">
                            @else
                                <div class="project-block">
                            @endif
                                <div class="project-block-name">{{ $project->name }}</div>
                                <div class="project-block-options">
                                    <a href="/dashboard/project/{{ $project->id }}/segment">Сегменты</a>
                                    <a href="/dashboard/project/{{ $project->id }}/experiment">Эксперименты</a>
                                    <a class="project-block-options-update" href="/dashboard/project/{{ $project->id }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="project-block-date">{{ date_create($project->added_at)->Format('d.m.Y') }}</div>
                            </div>
                        </div>
                    @endforeach
            @endif
@show
