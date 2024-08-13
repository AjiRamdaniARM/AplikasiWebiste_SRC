@props([
    'label' => null,
    'required' => 'true',
    'value' => null,
])

<div class="mb-3">
    @if(!is_null($label))
    <label for="{{ $name }}" class="text-capitalize">
        <strong>{{ $label }}</strong>
        @if ($required == 'true')
            <span class="text-danger">*</span>
        @endif
    </label>
    @endif
    <select
        {{ $attributes->merge(['class' => 'form-control', 'is-invalid' => $errors->has($name)]) }}
        id="{{ $name }}" 
        name="{{ $name }}" 
        @if ($required == 'true')
            required
        @endif>
        @if(!is_null($label))
            <option value="">Select {{ $label }}...</option>
        @endif
        {{ $slot }}
    </select>

    @error($name)
        <div class="invalid-feedback">{{ $message }}.</div>
    @enderror
</div>