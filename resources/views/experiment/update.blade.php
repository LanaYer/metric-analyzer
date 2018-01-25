@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}">{{ $project_id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}/experiment">Эксперименты</a><i class="icon-angle-right"></i></li>
        <li class="active">{{ $experiment[0]->id }}</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование эксперимента</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('experiment-update') }}">
                            {{ csrf_field() }}

                            <input name="id" value="{{ $experiment[0]->id }}" hidden>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Название</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $experiment[0]->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Описание</label>

                                <div class="col-md-10">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ $experiment[0]->description }}" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Abtest</label>

                                <div class="col-md-10">
                                    @if ($experiment[0]->is_abtest)
                                        <input name="is_abtest" type="checkbox" checked/>
                                    @else
                                        <input name="is_abtest" type="checkbox"/>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Активен</label>

                                <div class="col-md-10">
                                    @if ($experiment[0]->is_active)
                                        <input name="is_active" type="checkbox" checked/>
                                    @else
                                        <input name="is_active" type="checkbox"/>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Сегменты</label>

                                <div class="col-md-10">
                                    <select multiple="multiple" id="js-example-basic-multiple" name="segments[]">
                                        @foreach($segments as $segment)
                                            <option value="{{$segment->id}}">{{$segment->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#js-example-basic-multiple').select2();
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                    <a href="/dashboard/project/{{ $project_id }}/experiment">
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
