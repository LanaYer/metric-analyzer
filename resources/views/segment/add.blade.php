@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}">{{ $project_id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project_id }}/segment">Сегменты</a><i class="icon-angle-right"></i></li>
        <li class="active">Новый сегмент</li>
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
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ym_token') ? ' has-error' : '' }}">
                                <label for="ym_token" class="col-md-2 control-label">Сстраницы</label>

                                <div class="col-md-10">
                                    <select multiple="multiple" id="js-example-basic-multiple" name="pages[]">
                                        @foreach($pages as $page)
                                            <option value="{{$page->id}}">{{$page->name}}</option>
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
                                        Создать
                                    </button>
                                    <a href="/dashboard/project/{{ $project_id }}/segment">
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
