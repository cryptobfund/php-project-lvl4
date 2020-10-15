@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_massages.tasks')}}</h1>

<div class="d-flex shadow mb-2 px-lg-5 px-md-4 p-sm-3 p-2 rounded">
    <div>
        {{Form::open(['route' => ['tasks.index'], 'method' => 'GET', 'class' => 'form-inline'])}}
            {{Form::select(
                'filter[status_id]',
                $params['taskStatusesForSelect'],
                $filter['status_id'] ?? null,
                ['placeholder' => __('task_massages.default_status'), 'class' => 'form-control mr-2'])
             }}

            {{Form::select(
                'filter[created_by_id]',
                $params['usersForSelect'],
                $filter['created_by_id'] ?? null,
                ['placeholder' => __('task_massages.default_creator'), 'class' => 'form-control mr-2'])
            }}

            {{Form::select(
                'filter[assigned_to_id]',
                $params['usersForSelect'],
                $filter['assigned_to_id'] ?? null,
                ['placeholder' => __('task_massages.default_assignee'), 'class' => 'form-control mr-2'])
            }}

            {{Form::submit(__('task_massages.apply'), ['class' => 'btn btn-outline-primary mr-2'])}}
        {{Form::close()}}
    </div>
    @auth
        <a href="{{route("tasks.create")}}" class="btn btn-primary ml-auto">{{__('task_massages.add_new')}}</a>
    @endauth
</div>
<div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
<table class="table mt-2 table-hover table-striped">
    <thead class="text-muted">
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
</div>

@endsection
