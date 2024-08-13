<x-panel.app>
    <x-slot name="title">
        Create Participat
    </x-slot>
    <x-slot name="desc">
        Please note that the data that has been entered cannot be edited again
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('participant.invoice.team.store', ['invoice' => $inv->id]) }}" method="post">
                @csrf
                @foreach ($inv->itemRace as $key => $race)
                <div class="accordion mb-3" id="accordion{{ $key }}">
                    <div class="card">
                        <div class="card-header" id="heading{{ $key }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left px-0" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                    <strong>{{ $race->name }}</strong>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion{{ $key }}">
                            <div class="card-body">
                                @for ($i = 1; $i < $race->max_people + 1; $i++)
                                    <x-forms.input name="participants[{{ $race->id }}][]" 
                                        label="participant race {{ $race->name }}[{{ $i }}]"
                                    />
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    @push('extra-script')
    <script>

    </script>
    @endpush
</x-panel.app>