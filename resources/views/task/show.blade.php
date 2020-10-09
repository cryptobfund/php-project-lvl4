@extends('layouts.app')

@section('content')
    <div>
        <h1>
            {{__('task_massages.header_show')}}
            <a href="{{route('tasks.edit', $task)}}">&#9881;</a>
        </h1>
        <p>Name: {{$task->name}}</p>
        <p>Status: {{$task->status->name}}</p>
        <p>Description: {{$task->description}}</p>
        <p>Labels:</p>
    </div>


{{--    <form method="POST" action="{{route("tasks.update", $task)}}">--}}
{{--        @method('PATCH')--}}
{{--        @csrf--}}
{{--        @include('task.form')--}}
{{--        <input type="submit" value="{{__('task_massages.update')}}">--}}
{{--    </form>--}}
@endsection




