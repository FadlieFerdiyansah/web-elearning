<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <select name="{{ $attr }}[]" id="{{ $attr }}" class="form-control select2" multiple>
        @foreach ($dataArray as $item)
        <option value="{{ $item->$value }}">{{ $item->$labelOption }}</option>
        @endforeach
    </select>
</div>