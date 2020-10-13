@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('task_massages.new_task')}}</h1>

        {{Form::model($task, ['route' => 'tasks.store'])}}
            @include('task.form')
            {{Form::submit(__('task_massages.create'), ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

    </div>
@endsection
