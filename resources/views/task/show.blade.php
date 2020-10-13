@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1>
            {{__('task_massages.header_task')}}: {{$task->name}}
            <a href="{{route('tasks.edit', $task)}}">&#9881;</a>
        </h1>
        <p>{{__('task_massages.label_name')}}: {{$task->name}}</p>
        <p>{{__('task_massages.label_status')}}: {{$task->status->name}}</p>
        <p>{{__('task_massages.label_description')}}: {{$task->description ?? ''}}</p>
        <p>{{__('task_massages.label_assignee')}}: {{$task->assignee->name ?? ''}}</p>
        <p>{{__('task_massages.label_labels')}}:
            <ul>
                @foreach($task->labels()->get() as $label)
                    <li>{{$label->name}}</li>
                @endforeach
            </ul>
        </p>
    </div>

@endsection




