@extends('layouts.app')

@section('content')
    <div class="shadow p-lg-5 p-md-4 p-sm-3 p-2 rounded">
        <h1 class="mb-5">{{__('label_massages.edit_label')}}</h1>

        {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH'])}}
            @include('label.form')
        {{Form::submit(__('label_massages.update'), ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

    </div>
@endsection



