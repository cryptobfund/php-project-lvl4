@extends('layouts.app')

@section('content')
    <div><h1>{{__('task_status_massages.edit_status')}}</h1></div>

    <form method="POST" action="{{route("task_statuses.update", $taskStatus)}}">
        @method('PATCH')
        @csrf
        @include('task_status.form')
        <input type="submit" value="{{__('task_status_massages.update')}}">
    </form>
@endsection



