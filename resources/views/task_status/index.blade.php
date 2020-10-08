@extends('layouts.app')

@section('content')
<div><h1>{{__('task_status_massages.task_statuses')}}</h1></div>

@auth
<a href="{{route("task_statuses.create")}}">{{__('task_status_massages.add_new')}}</a>
@endauth

<table>
    <tr>
        <th>{{__('task_status_massages.col_id')}}</th>
        <th>{{__('task_status_massages.col_name')}}</th>
        <th>{{__('task_status_massages.col_created_at')}}</th>
    @auth
        <th>{{__('task_status_massages.col_actions')}}</th>
    @endauth
    </tr>
    @foreach($taskStatuses as $taskStatus)
        <tr>
            <th>{{$taskStatus->id}}</th>
            <th>{{$taskStatus->name}}</th>
            <th>{{date_format($taskStatus->created_at, 'M d Y' )}}</th>
            @auth
            <th>
                <a href="{{ route("task_statuses.destroy", $taskStatus) }}" data-confirm="{{__('task_status_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('task_status_massages.remove')}}</a>
                <a href="{{route("task_statuses.edit", $taskStatus)}}">{{__('task_status_massages.edit')}}</a>
            </th>
            @endauth
        </tr>
    @endforeach
</table>

@endsection
