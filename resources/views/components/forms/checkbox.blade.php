@props([
    'label' => null,
    'required' => 'true',
    'value' => null,
])

<div class="form-check mb-3">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" value="1" class="form-check-input" id="checkbox-{{ $name }}" name="{{ $name }}" @checked(old($name, isset($value) ? $value : null) == "1")>
    @if(!is_null($label))
        <label class="form-check-label text-capitalize" for="checkbox-{{ $name }}">
                <strong>{{ $label }}</strong>
                @if ($required == 'true')
                    <span class="text-danger">*</span>
                @endif
        </label>
    @endif
    @error($name)
        <div class="invalid-feedback">"{{ $message }}"</div>
    @enderror
</div>
