@extends('layouts.app')

@section('content')
<div><h1>{{__('label_massages.header_labels')}}</h1></div>

@auth
<a href="{{route("labels.create")}}">{{__('label_massages.add_new')}}</a>
@endauth

<table>
    <tr>
        <th>{{__('label_massages.col_id')}}</th>
        <th>{{__('label_massages.col_name')}}</th>
        <th>{{__('label_massages.col_description')}}</th>
        <th>{{__('label_massages.col_created_at')}}</th>
    @auth
        <th>{{__('label_massages.col_actions')}}</th>
    @endauth
    </tr>
    @foreach($labels as $label)
        <tr>
            <th>{{$label->id}}</th>
            <th>{{$label->name}}</th>
            <th>{{$label->description ?? ''}}</th>
            <th>{{date_format($label->created_at, 'M d Y' )}}</th>
            @auth
            <th>
                <a href="{{ route("labels.destroy", $label) }}" data-confirm="{{__('label_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('label_massages.remove')}}</a>
                <a href="{{route("labels.edit", $label)}}">{{__('label_massages.edit')}}</a>
            </th>
            @endauth
        </tr>
    @endforeach
</table>

@endsection
