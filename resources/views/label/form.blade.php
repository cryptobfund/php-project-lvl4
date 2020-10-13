<div class="form-group">

    {{Form::label('name', __('label_massages.label_name'))}}
    {{Form::text('name', $label->name, ['class' => 'form-control'])}}

</div>
<div class="form-group">

    {{Form::label('description', __('label_massages.label_description'))}}
    {{Form::text('description', $label->description, ['class' => 'form-control'])}}

</div>
