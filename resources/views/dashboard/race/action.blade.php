<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Option
    </button>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
        <a href="{{ route('race.participant.index', $model->id) }}" class="dropdown-item">Participant</a>
        <a href="{{ route('race.show', $model->id) }}" class="dropdown-item">Show</a>
        <a href="{{ route('race.edit', $model->id) }}" class="dropdown-item">Edit</a>
        <a href="{{ route('race.destroy', $model->id) }}" class="dropdown-item" data-confirm-delete="true">Delete</a>
    </div>
</div>
