@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('label_massages.edit_label')}}</h1>

<form method="POST" action="{{route("labels.update", $label)}}" accept-charset="UTF-8" class="w-50">
    @method('PATCH')
    @csrf
    @include('label.form')
    <input class="btn btn-primary" type="submit" value="{{__('label_massages.update')}}">
</form>
@endsection



