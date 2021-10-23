<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <select name="{{ $attr }}" id="{{ $attr }}" class="form-control">
        @foreach ($dataArray as $item)
            <option value="{{ $item->$valueOption }}">{{ Str::title($item->$labelOption) }}</option>
        @endforeach
    </select>
</div>