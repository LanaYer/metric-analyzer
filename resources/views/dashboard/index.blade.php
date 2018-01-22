@section('content')
    <div class="dashboard-new">
        <a href="/new-project"><button type="button" class="btn btn-primary">Новый проект</button></a>
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
                                    <a href="/dashboard/project/{{ $project->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                                <div class="project-block-date">{{ $project->added_at }}</div>
                            </div>
                        </div>
                    @endforeach
            @endif
@show
