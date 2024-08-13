<x-panel.app>
    <x-slot name="title">
        Participant Race {{ $cont->name }}
    </x-slot>

    <a href="{{ route('race.participant.create', $cont->id) }}" class="btn btn-success mb-3" target="_blank"><i class="fas fa-file-excel"></i> Export</a>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Invoice ID</th>
                            <th class="text-capitalize">Name</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    @push('extra-script')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('race.participant.index', $cont->id) !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'invoice', name: 'invoice.name' },
                    { data: 'name', name: 'name' },
                ]
            });
        });
    </script>
    @endpush
</x-panel.app>