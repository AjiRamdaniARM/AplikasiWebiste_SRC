{{-- Button trigger modal --}}
<button type="button" {{ $attributes->merge(['class' => 'btn btn-success mb-3']) }} data-toggle="modal" data-target="#{{ $modalId }}">
    {{ $modalName }}
</button>