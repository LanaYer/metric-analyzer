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
        <li><a href="/dashboard/project/{{ $project->id}}">{{ $project->id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id }}/experiment">Эксперименты</a><i class="icon-angle-right"></i></li>
        <li class="active">Новый эксперимент</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новый эксперимент</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('experiment-add') }}">
                            {{ csrf_field() }}

                            <input name="project_id" value="{{ $project->id }}" hidden>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Название</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Описание</label>

                                <div class="col-md-10">
                                    <input id="description" type="text" class="form-control" name="description" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('is_abtest') ? ' has-error' : '' }}">
                                <label for="is_abtest" class="col-md-2 control-label">Abtest</label>

                                <div class="col-md-10 form-active-checkbox">
                                    <input name="is_abtest" type="checkbox"/>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Сегменты</label>

                                <div class="col-md-10">
                                    <select multiple="multiple" id="js-segments-multiple" name="segments[]">
                                        @foreach($project->segments as $segment)
                                            <option value="{{$segment->id}}">{{$segment->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#js-segments-multiple').select2();
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Страницы</label>

                                <div class="col-md-10">
                                    <select multiple="multiple" id="js-pages-multiple" name="pages[]">
                                        @foreach($project->pages as $page)
                                            <option value="{{$page->id}}">{{$page->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#js-pages-multiple').select2();
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Создать
                                    </button>
                                    <a href="/dashboard/project/{{ $project->id }}/experiment">
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
