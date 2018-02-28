@extends('layouts.app')
<?php
/**
 * @var \App\Models\Project $project
 * @var \App\Models\Experiment $experiment
 *
 */
?>
@section('breadcrumbs')
    <ul class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}">{{ $project->id  }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}/experiment">Эксперимент {{ $experiment->id }}</a><i class="icon-angle-right"></i></li>
        <li><a href="/dashboard/project/{{ $project->id  }}/experiment/{{ $experiment->id }}/step">Этапы</a><i class="icon-angle-right"></i></li>
        <li class="active">Новый этап</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новый этап</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('step-add') }}">
                            {{ csrf_field() }}

                            <input name="experiment_id" value="{{ $experiment->id }}" hidden>
                            <input name="project_id" value="{{ $project->id  }}" hidden>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Описание</label>

                                <div class="col-md-10">
                                    <textarea id="description" type="text" class="form-control" name="description" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                                <label for="start_at" class="col-md-2 control-label">Дата начала</label>

                                <div class="col-md-10">
                                    <div class="input-group date start_at col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="start_at" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="start_at" name="start_at" value="" /><br/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Создать
                                    </button>
                                    <a href="/dashboard/project/{{ $project->id  }}/experiment">
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

@section('js')
    <script type="text/javascript">

        $('.start_at').datetimepicker({
            language:  'ru',
            todayBtn:  1,
            autoclose: 1,
            startView: 2,
            minView: 2
        });
    </script>
@endsection