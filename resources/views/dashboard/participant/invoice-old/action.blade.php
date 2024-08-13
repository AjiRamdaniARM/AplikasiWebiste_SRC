@if($model->status == 'unpaid')
    <a href="{{ route('participant.invoice.show', $model->name) }}" class="btn btn-success btn-sm">Payment</a>
@endif

@if($model->status == 'paid')
    <a href="{{ route('participant.invoice.team.index', $model->id) }}" class="btn btn-primary btn-sm">Participant</a>
@endif