@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('label_massages.new_label')}}</h1>

        {{ Form::model($label, ['route' => 'labels.store']) }}
            @include('label.form')
        {{Form::submit(__('label_massages.create'), ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

    </div>
@endsection
