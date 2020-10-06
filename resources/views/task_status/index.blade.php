@extends('layouts.app')

@section('content')
<div><h1>Task Status</h1></div>

@auth
<a href="{{route("task_statuses.create")}}">Add New</a>
@endauth

<table>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Created At</th>
    @auth
        <th>Actions</th>
    @endauth
    </tr>
    @foreach($taskStatuses as $taskStatus)
        <tr>
            <th>{{$taskStatus['id']}}</th>
            <th>{{$taskStatus['name']}}</th>
            <th>{{date_format($taskStatus['created_at'], 'M d Y' )}}</th>
            @auth
            <th>
                <a href="{{ route("task_statuses.destroy", $taskStatus) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow">Remove</a>
                <a href="{{route("task_statuses.edit", $taskStatus)}}">Edit</a>
            </th>
            @endauth
        </tr>
    @endforeach
</table>

@endsection
