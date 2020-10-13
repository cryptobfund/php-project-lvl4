@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('task_status_massages.new_status')}}</h1>

        {{ Form::model($taskStatus, ['route' => 'task_statuses.store']) }}
        @include('task_status.form')
        {{Form::submit(__('task_status_massages.create'), ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

    </div>
@endsection

