@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id }}">{{ $project->id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id }}/segment">Сегменты</a><i class="icon-angle-right"></i></li>
        <li class="active">{{ $page->id }}</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новый сегмент</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('page-update') }}">
                            {{ csrf_field() }}

                            <input name="page_id" value="{{$page->id}}" hidden>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Название</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" value="{{$page->name}}" name="name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="page" class="col-md-2 control-label">Страница</label>

                                <div class="col-md-10">
                                    <input id="page" type="text" class="form-control" value="{{$page->pages}}" name="page" required autofocus>

                                    @if ($errors->has('page'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('page') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                    <a href="/dashboard/project/{{ $project->id }}/page">
                                        <button type="button" class="btn btn-secondary">Отмена</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
