<div class="form-group">

    {{Form::label('name', __('task_massages.label_name'))}}
    {{Form::text('name', $task->name, ['class' => 'form-control'])}}

</div>

<div class="form-group">

    {{Form::label('description', __('task_massages.label_description'))}}
    {{Form::textarea('description', $task->description, ['class' => 'form-control', 'cols' => '50', 'rows' => '5'])}}

</div>

<div class="form-group">

    {{Form::label('status_id', __('task_massages.label_status'))}}
    {{Form::select('status_id', $params['taskStatusesForSelect'], $task->status_id ?? 1, ['placeholder' => __('task_massages.default_status'), 'class' => 'form-control'])}}

</div>

<div class="form-group">

    {{Form::label('assigned_to_id', __('task_massages.label_assignee'))}}
    {{Form::select('assigned_to_id', $params['usersForSelect'], $task->assigned_to_id ?? null, ['placeholder' => __('task_massages.default_assignee'), 'class' => 'form-control'])}}

</div>

<div class="form-group">

    {{Form::label('labels', __('task_massages.label_labels'))}}
    {{Form::select('labels[]', $params['labelsForSelect'], $params['labelsForSelectSelected'], ['placeholder' => "", 'class' => 'form-control', 'multiple', 'size' => '5'])}}

</div>
