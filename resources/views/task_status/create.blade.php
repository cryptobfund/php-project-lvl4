@extends('layouts.app')

@section('content')
    <div><h1>{{__('task_status_massages.new_status')}}</h1></div>

    <form method="POST" action="{{route("task_statuses.store")}}">
        @csrf
        @include('task_status.form')
        <input type="submit" value="{{__('task_status_massages.Create')}}">
    </form>
@endsection

