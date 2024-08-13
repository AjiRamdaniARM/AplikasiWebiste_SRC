<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Option
    </button>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editOrganized" data-id="{{ $model->id }}" data-name="{{ $model->name }}" data-type="{{ $model->type }}" data-image="{{ $model->image }}">
            Edit
        </button>
        <a href="{{ route('organized.destroy', $model->id) }}" class="dropdown-item" data-confirm-delete="true">Delete</a>
    </div>
</div>
