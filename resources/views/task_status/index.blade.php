@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_status_massages.task_statuses')}}</h1>

@auth
<a href="{{route("task_statuses.create")}}" class="btn btn-primary">{{__('task_status_massages.add_new')}}</a>
@endauth

<div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
    <table class="table mt-2 table-hover table-striped">
        <thead class="text-muted">
            <tr>
                <th>{{__('task_status_massages.col_id')}}</th>
                <th>{{__('task_status_massages.col_name')}}</th>
                <th>{{__('task_status_massages.col_created_at')}}</th>
            @auth
                <th>{{__('task_status_massages.col_actions')}}</th>
            @endauth
            </tr>
        </thead>
        <tbody></tbody>
            @foreach($taskStatuses as $taskStatus)
                <tr>
                    <td>{{$taskStatus->id}}</td>
                    <td>{{$taskStatus->name}}</td>
                    <td>{{date_format($taskStatus->created_at, 'M d Y' )}}</td>
                    @auth
                    <td>
                        <a href="{{ route("task_statuses.destroy", $taskStatus) }}" data-confirm="{{__('task_status_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('task_status_massages.remove')}}</a>
                        <a href="{{route("task_statuses.edit", $taskStatus)}}">{{__('task_status_massages.edit')}}</a>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
