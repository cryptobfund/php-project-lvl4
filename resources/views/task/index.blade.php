@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_massages.tasks')}}</h1>

<div class="d-flex">
    <div>
        <form method="GET" action="{{route('tasks.index')}}" accept-charset="UTF-8" class="form-inline">

            <select class="form-control mr-2" name="filter[status_id]">
                <option selected value="">{{__('task_massages.default_status')}}</option>
                @foreach($params['taskStatuses'] as $status)
                    @if ($filter && $filter['status_id'] == $status->id)
                        <option selected value="{{$filter['status_id']}}">{{$filterActiveValues['taskStatusName'] ?? __('task_massages.default_status')}}</option>
                    @else
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endif
                @endforeach
            </select>

            <select class="form-control mr-2" name="filter[created_by_id]">
                <option selected value="">{{__('task_massages.default_creator')}}</option>
                @foreach($params['users'] as $user)
                    @if ($filter && $filter['created_by_id'] == $user->id)
                        <option selected value="{{$filter['created_by_id']}}">{{$filterActiveValues['taskCreatorName'] ?? __('task_massages.default_creator')}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif
                @endforeach
            </select>

            <select class="form-control mr-2" name="filter[assigned_to_id]">
                <option selected value="">{{__('task_massages.default_assignee')}}</option>
                @foreach($params['users'] as $user)
                    @if ($filter && $filter['assigned_to_id'] == $user->id)
                        <option selected value="{{$filter['assigned_to_id']}}">{{$filterActiveValues['taskAssigneeName'] ?? __('task_massages.default_assignee')}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif
                @endforeach
            </select>

            <input class="btn btn-outline-primary mr-2" type="submit" value="Apply">
        </form>
    </div>
    @auth
        <a href="{{route("tasks.create")}}" class="btn btn-primary ml-auto">{{__('task_massages.add_new')}}</a>
    @endauth

</div>

<table class="table mt-2">
    <thead>
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
    </thead>
    <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->status->name}}</td>
                <td>
                    <a href="{{route("tasks.show", $task)}}">{{$task->name}}</a>
                </td>
                <td>{{$task->creator->name}}</td>
                <td>{{$task->assignee->name ?? ''}}</td>
                <td>{{date_format($task->created_at, 'M d Y' )}}</td>
                @auth
                    <td>
                        @can('delete', $task)
                            <a href="{{ route("tasks.destroy", $task) }}" data-confirm="{{__('task_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('task_massages.remove')}}</a>
                        @endcan
                            <a href="{{route("tasks.edit", $task)}}">{{__('task_massages.edit')}}</a>
                    </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
