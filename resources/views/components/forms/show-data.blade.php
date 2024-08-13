@props([
    'id' => null
    ])
<div class="mb-3">
    <label class="mb-0 text-capitalize">
        <strong>{{ $label }}</strong>
    </label>
    <span 
        {{ $attributes->merge(['class' => 'border-bottom d-block']) }}
        {{ is_null($id) ? null : 'id='.$id }}>
        {!! html_entity_decode($value) !!}
    </span>
</div>