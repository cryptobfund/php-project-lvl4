@extends('layouts.app')

@section('content')
<div><h1>{{__('task_massages.tasks')}}</h1></div>

@auth
<a href="{{route("tasks.create")}}">{{__('task_massages.add_new')}}</a>
@endauth

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
