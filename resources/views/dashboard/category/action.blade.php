<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Option
    </button>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editCategory" data-id="{{ $model->id }}" data-name="{{ $model->name }}">
            Edit
        </button>
        <a href="{{ route('category.destroy', $model->id) }}" class="dropdown-item" data-confirm-delete="true">Delete</a>
    </div>
</div>
