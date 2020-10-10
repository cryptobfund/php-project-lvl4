<div>
    <div>
        <label for="name">{{__('task_massages.label_name')}}</label>
        <input type="text" name="name" id="name" value="{{$task->name ?? ''}}">
    </div>
    <div>
        <label for="description">{{__('task_massages.label_description')}}</label>
        <textarea name="description" id="description">{{$task->description ?? ''}}</textarea>
    </div>
    <div>
        <label for="status_id">{{__('task_massages.label_status')}}</label>
        <select name="status_id" id="status_id">
            <option selected value="{{$task->status_id ?? 1}}">{{$task->status->name ?? __('task_massages.default_status')}}</option>
            @foreach($params['taskStatuses'] as $status)
                <option value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="assigned_to_id">{{__('task_massages.label_assignee')}}</label>
        <select name="assigned_to_id" id="assigned_to_id">
            <option selected value="{{$task->assigned_to_id ?? ''}}">{{$task->assignee->name ?? __('task_massages.default_assignee')}}</option>
            @foreach($params['users'] as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="labels">{{__('task_massages.label_labels')}}</label>
        <select name="labels[]" multiple id="labels" size="5">
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

</div>
