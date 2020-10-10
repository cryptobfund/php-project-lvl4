@extends('layouts.app')

@section('content')
<div><h1>{{__('task_massages.tasks')}}</h1></div>

<div>
    <form method="GET" action="{{route('tasks.index')}}">

        <select name="filter[status_id]">
            <option selected value="">{{__('task_massages.default_status')}}</option>
            @foreach($params['taskStatuses'] as $status)
                @if ($filter && $filter['status_id'] == $status->id)
                    <option selected value="{{$filter['status_id']}}">{{$filterActiveValues['taskStatusName'] ?? __('task_massages.default_status')}}</option>
                @else
                    <option value="{{$status->id}}">{{$status->name}}</option>
                @endif
            @endforeach
        </select>

        <select name="filter[created_by_id]">
            <option selected value="">{{__('task_massages.default_creator')}}</option>
            @foreach($params['users'] as $user)
                @if ($filter && $filter['created_by_id'] == $user->id)
                    <option selected value="{{$filter['created_by_id']}}">{{$filterActiveValues['taskCreatorName'] ?? __('task_massages.default_creator')}}</option>
                @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
            @endforeach
        </select>

        <select name="filter[assigned_to_id]">
            <option selected value="">{{__('task_massages.default_assignee')}}</option>
            @foreach($params['users'] as $user)
                @if ($filter && $filter['assigned_to_id'] == $user->id)
                    <option selected value="{{$filter['assigned_to_id']}}">{{$filterActiveValues['taskAssigneeName'] ?? __('task_massages.default_assignee')}}</option>
                @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
            @endforeach
        </select>

        <input type="submit" value="Apply">
    </form>

    @auth
        <a href="{{route("tasks.create")}}">{{__('task_massages.add_new')}}</a>
    @endauth
</div>

<table>
    <tr>
        <th>{{__('task_massages.col_id')}}</th>
        <th>{{__('task_massages.col_status')}}</th>
        <th>{{__('task_massages.col_name')}}</th>
        <th>{{__('task_massages.col_creator')}}</th>
        <th>{{__('task_massages.col_assignee')}}</th>
        <th>{{__('task_massages.col_created_at')}}</th>
    @auth
        <th>{{__('task_massages.col_actions')}}</th>
    @endauth
    </tr>
    @foreach($tasks as $task)
        <tr>
            <th>{{$task->id}}</th>
            <th>{{$task->status->name}}</th>
            <th>
                <a href="{{route("tasks.show", $task)}}">{{$task->name}}</a>
            </th>
            <th>{{$task->creator->name}}</th>
            <th>{{$task->assignee->name ?? ''}}</th>
            <th>{{date_format($task->created_at, 'M d Y' )}}</th>
            @auth
                <th>
                    @can('delete', $task)
                        <a href="{{ route("tasks.destroy", $task) }}" data-confirm="{{__('task_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('task_massages.remove')}}</a>
                    @endcan
                        <a href="{{route("tasks.edit", $task)}}">{{__('task_massages.edit')}}</a>
                </th>
            @endauth
        </tr>
    @endforeach
</table>

@endsection
