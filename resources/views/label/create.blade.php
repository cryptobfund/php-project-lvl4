@extends('layouts.app')

@section('content')
    <div><h1>{{__('label_massages.new_label')}}</h1></div>

    <form method="POST" action="{{route("labels.store")}}">
        @csrf
        @include('label.form')
        <input type="submit" value="{{__('label_massages.create')}}">
    </form>
@endsection

