@props([
    'label' => null,
    'required' => 'true',
    'type' => 'text',
    'value' => null,
    'help' => null
])

<div class="form-group mb-3">
    @if(!is_null($label))
        <label for="{{ $name }}" class="text-capitalize">
            <strong>{{ $label }}</strong>
            @if ($required == 'true')
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <input 
        type="{{ $type }}" 
        {{ $attributes->merge(['class' => 'form-control', 'is-invalid' => $errors->has($name)]) }}
        id="{{ $name }}"
        name="{{ $name }}"
        aria-describedby="{{ $name }}"
        @if(!is_null($label))
            placeholder="Enter {{ $label }}..."
        @endif
        value="{{ old($name, isset($value) ? $value : null) }}"
        @if ($required == 'true')
            required
        @endif
    >
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}.</div>
    @enderror

    @if(!empty($help))
        <small id="{{ $name }}" class="form-text text-muted">{{ $help }}</small>
    @endif
</div>