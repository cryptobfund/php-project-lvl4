@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2">
        <h1 class="mb-5">{{__('label_massages.new_label')}}</h1>

        <form method="POST" action="{{route("labels.store")}}" accept-charset="UTF-8">
            @csrf
            @include('label.form')
            <input class="btn btn-primary" type="submit" value="{{__('label_massages.create')}}">
        </form>
    </div>
@endsection
