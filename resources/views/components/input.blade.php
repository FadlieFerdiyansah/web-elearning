<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <input type="{{ $type ?? 'text'}}" name="{{ $attr }}" class="form-control @error($attr) is-invalid @enderror" id="{{ $attr }}" 
        @isset($autofocus)
            autofocus="{{ $autofocus }}"
        @endisset
        @isset($value)
            value="{{ old($attr, $value) }}"
        @else
            value="{{ old($attr) }}"
        @endisset
        
        @isset($readonly)
            readonly
        @endisset
        @isset($placeholder)
            placeholder="{{ $placeholder }}"
        @endisset
    >

    {{-- Ketika error --}}
    @error($attr)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>