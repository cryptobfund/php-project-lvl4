@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2">
        <h1 class="mb-5">{{__('task_massages.edit_task')}}</h1>

        <form method="POST" action="{{route("tasks.update", $task)}}" accept-charset="UTF-8">
            @method('PATCH')
            @csrf
            @include('task.form')
            <input class="btn btn-primary" type="submit" value="{{__('task_massages.update')}}">
        </form>
    </div>
@endsection
