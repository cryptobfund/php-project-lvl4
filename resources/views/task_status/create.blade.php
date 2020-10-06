@extends('layouts.app')

@section('content')
    <div><h1>Add New Task Status</h1></div>

    <form method="POST" action="{{route("task_statuses.store")}}">
        @csrf
        @include('task_status.form')
        <input type="submit" value="Create">
    </form>
@endsection
