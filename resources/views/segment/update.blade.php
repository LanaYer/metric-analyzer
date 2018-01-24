@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
        <li class="active">{{ $project_id }}<i class="icon-angle-right"></i></li>
        <li class="active">Сегменты</li>
        <li class="active">{{$segment[0]->name}}</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новый сегмент</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('segment-add') }}">
                            {{ csrf_field() }}

                            <input name="project_id" value="{{ $project_id }}" hidden>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Название</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" value="{{$segment[0]->name}}" name="name" required autofocus>

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
                                    <input id="page" type="text" class="form-control" value="{{$segment[0]->pages}}" name="page" required autofocus>

                                    @if ($errors->has('page'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('page') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
