<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $attr }}" class="form-control @error($attr) is-invalid @enderror" id="{{ $attr }}" 
        @isset($autofocus)
            autofocus="{{ $autofocus }}"
        @endisset
        @isset($value)
            value="{{ old($attr, $value) }}"
        @else
            value="{{ old($attr) }}"
        @endisset
    >

    {{-- Ketika error --}}
    @error($attr)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>