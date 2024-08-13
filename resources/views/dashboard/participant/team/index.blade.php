<x-panel.app>
    <x-slot name="title">
        Manage Participat
    </x-slot>
    <x-slot name="desc">
        Please note that the data that has been entered cannot be edited again
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            @foreach ($inv->participants->groupBy('race_id') as $key => $participants)
            <div class="accordion mb-3" id="accordion{{ $key }}">
                <div class="card">
                    <div class="card-header" id="heading{{ $key }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left px-0" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                <strong>{{ $participants[0]->race->name }}</strong>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion{{ $key }}">
                        <div class="card-body">
                            @foreach ($participants as $participant)
                                <x-forms.show-data label="name participant {{ $participant->race->name }}" value="{{ $participant->name }}" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @push('extra-script')
    <script>

    </script>
    @endpush
</x-panel.app>