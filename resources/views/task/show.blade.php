@extends('layouts.app')

@section('content')
    <div><h1>{{__('task_massages.edit_task')}}</h1></div>

    <form method="POST" action="{{route("tasks.update", $task)}}">
        @method('PATCH')
        @csrf
        @include('task.form')
        <input type="submit" value="{{__('task_massages.update')}}">
    </form>
@endsection
