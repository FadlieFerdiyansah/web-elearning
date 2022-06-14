<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <select name="{{ $attr }}[]" id="{{ $attr }}" class="form-control select2 @error($attr)is-invalid @enderror" multiple>
        @foreach ($dataArray as $item)
        <option 
            @isset($isSelected)
                {{ $isSelected->find($item->id) ? 'selected' : '' }}
            @endisset
            value="{{ $item->$valueOption }}">{{ $item->$labelOption }}</option>
        @endforeach
    </select>
    {{-- Ketika error --}}
    @error($attr)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>