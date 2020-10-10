<div>
    <div>
        <label for="name">{{__('label_massages.label_name')}}</label>
        <input type="text" name="name" id="name" value="{{$label->name ?? ''}}">
    </div>
    <div>
        <label for="description">{{__('label_massages.label_description')}}</label>
        <textarea name="description" id="description">{{$label->description ?? ''}}</textarea>
    </div>
    <div>
</div>
