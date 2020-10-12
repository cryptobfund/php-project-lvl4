<div class="form-group">
    <label for="name">{{__('task_massages.label_name')}}</label>
    <input class="form-control" type="text" name="name" id="name" value="{{$task->name ?? ''}}">
</div>
<div class="form-group">
    <label for="description">{{__('task_massages.label_description')}}</label>
    <textarea class="form-control" name="description" cols="50" rows="5" id="description">{{$task->description ?? ''}}</textarea>
</div>
<div class="form-group">
    <label for="status_id">{{__('task_massages.label_status')}}</label>
    <select class="form-control" name="status_id" id="status_id">
        <option selected value="{{$task->status_id ?? 1}}">{{$task->status->name ?? __('task_massages.default_status')}}</option>
        @foreach($params['taskStatuses'] as $status)
            <option value="{{$status->id}}">{{$status->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="assigned_to_id">{{__('task_massages.label_assignee')}}</label>
    <select class="form-control" name="assigned_to_id" id="assigned_to_id">
        <option selected value="{{$task->assigned_to_id ?? ''}}">{{$task->assignee->name ?? __('task_massages.default_assignee')}}</option>
        @foreach($params['users'] as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="labels">{{__('task_massages.label_labels')}}</label>
    <select class="form-control" name="labels[]" multiple id="labels" size="5">
        <option selected value=""></option>
        @foreach($params['labels'] as $label)
            @if($task->labels()->get()->contains($label))
                <option selected value="{{$label->id}}">{{$label->name}}</option>
            @else
                <option value="{{$label->id}}">{{$label->name}}</option>
            @endif
        @endforeach
    </select>
</div>
