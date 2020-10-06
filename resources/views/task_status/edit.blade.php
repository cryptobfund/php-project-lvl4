@extends('layouts.app')

@section('content')
    <div><h1>Edit Task Status</h1></div>

    <form method="POST" action="{{route("task_statuses.update", $taskStatus)}}">
        @method('PATCH')
        @csrf
        @include('task_status.form')
        <input type="submit" value="Update">
    </form>
@endsection



