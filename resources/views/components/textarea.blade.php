<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <textarea name="{{ $attr }}" id="{{ $attr }}"
        class="form-control @error($attr) is-invalid @enderror" 
        @isset($readonly)
        readonly
        @endisset
        @isset($placeholder)
            placeholder="{{ $placeholder }}"
        @endisset
    >{{ $slot }}</textarea>
    {{-- Ketika error --}}
    @error($attr)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>