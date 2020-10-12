@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('label_massages.header_labels')}}</h1>

@auth
<a href="{{route("labels.create")}}" class="btn btn-primary">{{__('label_massages.add_new')}}</a>
@endauth

<div class="shadow p-3 rounded">
    <table class="table mt-2 table-hover table-striped">
        <thead class="text-muted">
            <tr>
                <th>{{__('label_massages.col_id')}}</th>
                <th>{{__('label_massages.col_name')}}</th>
                <th>{{__('label_massages.col_description')}}</th>
                <th>{{__('label_massages.col_created_at')}}</th>
            @auth
                <th>{{__('label_massages.col_actions')}}</th>
            @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
                <tr>
                    <td>{{$label->id}}</td>
                    <td>{{$label->name}}</td>
                    <td>{{$label->description ?? ''}}</td>
                    <td>{{date_format($label->created_at, 'M d Y' )}}</td>
                    @auth
                    <td>
                        <a href="{{ route("labels.destroy", $label) }}" data-confirm="{{__('label_massages.delete_confirm')}}" data-method="delete" rel="nofollow">{{__('label_massages.remove')}}</a>
                        <a href="{{route("labels.edit", $label)}}">{{__('label_massages.edit')}}</a>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
