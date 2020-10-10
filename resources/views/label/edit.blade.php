@extends('layouts.app')

@section('content')
    <div><h1>{{__('label_massages.edit_label')}}</h1></div>

    <form method="POST" action="{{route("labels.update", $label)}}">
        @method('PATCH')
        @csrf
        @include('label.form')
        <input type="submit" value="{{__('label_massages.update')}}">
    </form>
@endsection



