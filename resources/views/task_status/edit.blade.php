@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('task_status_massages.edit_status')}}</h1>

        {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH'])}}
        @include('task_status.form')
        {{Form::submit(__('task_status_massages.update'), ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

    </div>
@endsection



