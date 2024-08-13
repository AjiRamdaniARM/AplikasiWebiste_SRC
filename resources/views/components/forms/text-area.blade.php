@props([
    'label' => null,
    'required' => 'true',
    'value' => null,
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

    <textarea 
        {{ $attributes->merge(['class' => 'form-control', 'is-invalid' => $errors->has($name)]) }}
        id="{{ $name }}"
        name="{{ $name }}"
        @if(!is_null($label))
            placeholder="Enter {{ $label }}..."
        @endif
        @if ($required == 'true')
            required
        @endif
        rows="3"
    >{!! old($name, isset($value) ? $value : null) !!}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}.</div>
    @enderror
</div>
