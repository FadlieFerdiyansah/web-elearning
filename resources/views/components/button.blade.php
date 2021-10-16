<div class="form-group">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-dark text-uppercase']) }}>
        {{ $slot }}
    </button>
</div>