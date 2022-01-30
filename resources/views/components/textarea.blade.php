<div class="form-group">
    <label for="{{ $attr }}">{{ $label }}</label>
    <textarea name="{{ $attr }}" id="{{ $attr }}"
        class="form-control @error($attr) is-invalid @enderror">{{ $slot }}</textarea>
    {{-- Ketika error --}}
    @error($attr)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>