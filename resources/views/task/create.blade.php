@extends('layouts.app')

@section('content')
    <div><h1>{{__('task_massages.new_task')}}</h1></div>

    <form method="POST" action="{{route("tasks.store")}}">
        @csrf
        @include('task.form')
        <input type="submit" value="{{__('task_massages.Create')}}">
    </form>
@endsection
