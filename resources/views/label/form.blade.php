<div class="form-group">
    <label for="name">{{__('label_massages.label_name')}}</label>
    <input class="form-control" type="text" name="name" id="name" value="{{$label->name ?? ''}}">
</div>
<div class="form-group">
    <label for="description">{{__('label_massages.label_description')}}</label>
    <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{$label->description ?? ''}}</textarea>
</div>
