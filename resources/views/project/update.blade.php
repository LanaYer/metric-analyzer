@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
        <li class="active">Редактирование проекта</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование проекта</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('project-update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Название</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $project[0]->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-2 control-label">Url</label>

                                <div class="col-md-10">
                                    <input id="url" type="text" class="form-control" name="url" value="{{ $project[0]->url }}" required autofocus>

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_login') ? ' has-error' : '' }}">
                                <label for="ym_login" class="col-md-2 control-label">Логин</label>

                                <div class="col-md-10">
                                    <input id="ym_login" type="text" class="form-control" name="ym_login" value="{{ $project[0]->ym_login }}" required autofocus>

                                    @if ($errors->has('ym_login'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ym_login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Токен</label>

                                <div class="col-md-10">
                                    <input id="ym_token" type="text" class="form-control" name="ym_token" value="{{ $project[0]->ym_token }}" required autofocus>

                                    @if ($errors->has('ym_token'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ym_token') }}</strong>
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
