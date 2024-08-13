@props([
    'buttonName' => 'Save',
])

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">{{ $buttonName }}</button>
</div>
