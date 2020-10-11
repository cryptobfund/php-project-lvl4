@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task_status_massages.new_status')}}</h1>

<form method="POST" action="{{route("task_statuses.store")}}" accept-charset="UTF-8" class="w-50">
    @csrf
    @include('task_status.form')
    <input class="btn btn-primary" type="submit" value="{{__('task_status_massages.Create')}}">
</form>
@endsection

