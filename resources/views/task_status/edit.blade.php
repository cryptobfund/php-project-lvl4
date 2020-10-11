@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_status_massages.edit_status')}}</h1>

<form method="POST" action="{{route("task_statuses.update", $taskStatus)}}" accept-charset="UTF-8" class="w-50">
    @method('PATCH')
    @csrf
    @include('task_status.form')
    <input class="btn btn-primary" type="submit" value="{{__('task_status_massages.update')}}">
</form>
@endsection



