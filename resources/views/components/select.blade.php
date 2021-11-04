<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <select name="{{ $attr }}" id="{{ $attr }}" class="form-control">
        {{-- Jika datanya adalah array/collection yang lebih dari 1  --}}
        @if(isset($dataArray))
            @foreach ($dataArray as $item)
                <option value="{{ $item->$valueOption }}">{{ Str::title($item->$labelOption) }}</option>
            @endforeach
            {{-- Jika data nya bukan array/collection atau hanya 1 data--}}
            @elseif(isset($data))
                @if (isset($relasi))
                {{-- Jika label option nya ada relasi --}}
                    <option value="{{ $data->$valueOption }}">{{ $data->$relasi->$labelOption }}</option>
                @else
                {{-- Jika label option tidak ada relasi --}}
                    <option value="{{ $data->$valueOption }}">{{ $data->$labelOption }}</option>
                @endif
        @endif
    </select>
</div>