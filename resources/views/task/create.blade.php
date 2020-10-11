@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_massages.new_task')}}</h1>

<form method="POST" action="{{route("tasks.store")}}" accept-charset="UTF-8" class="w-50">
    @csrf
    @include('task.form')
    <input class="btn btn-primary" type="submit" value="{{__('task_massages.Create')}}">
</form>
@endsection
