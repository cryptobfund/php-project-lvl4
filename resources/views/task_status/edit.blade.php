@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('task_status_massages.edit_status')}}</h1>

        <form method="POST" action="{{route("task_statuses.update", $taskStatus)}}" accept-charset="UTF-8">
            @method('PATCH')
            @csrf
            @include('task_status.form')
            <input class="btn btn-primary" type="submit" value="{{__('task_status_massages.update')}}">
        </form>
    </div>
@endsection



