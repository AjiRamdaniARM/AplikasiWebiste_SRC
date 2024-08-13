<x-panel.app>
    <x-slot name="title">
        List Invoice
    </x-slot>

    <x-slot name="desc">
        Please select the race that will be followed can be more than one !! Contest Payment Through Account : BSI 7225018237 A/N Sukarobot Academy.
    </x-slot>

    <a href="{{ route('participant.race.index') }}" class="btn btn-success mb-3">Register</a>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Name</th>
                            <th class="text-capitalize">Status</th>
                            <th class="text-capitalize">Race</th>
                            <th class="text-capitalize">Total</th>
                            <th class="text-capitalize">Created At</th>
                            <th class="text-capitalize">Action</th>
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
                ajax: '{!! route('participant.invoice.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'status', name: 'status' },
                    { data: 'races', name: 'races', orderable: false, searchable: false },
                    { data: 'sum', name: 'sum', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
    @endpush
</x-panel.app>