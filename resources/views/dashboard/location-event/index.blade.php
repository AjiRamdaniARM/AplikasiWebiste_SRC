<x-panel.app>
    <x-slot name="title">
        Manage location event
    </x-slot>

    <x-slot name="desc">
        Only one location event will be displayed, namely the first
    </x-slot>

    <x-modal.button-triger modalId="createLocationEvent" modalName="Create"/>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">name</th>
                            <th class="text-capitalize">address</th>
                            <th class="text-capitalize">link address</th>
                            <th class="text-capitalize">Author</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <x-modal modalId="createLocationEvent" modalTitle="Create location event">
        <form action="{{ route('location-event.store') }}" method="post">
            @csrf
            <x-forms.input name="name" 
                label="name"
            />
            <x-forms.input name="address" 
                label="address"
            />
            <x-forms.input name="link_address" 
                label="link address"
                help="link location google map"
            />

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editLocationEvent" modalTitle="Edit location event">
        <form action="" method="post" id="formEditLocationEvent">
            @csrf
            @method('PUT')
            <x-forms.input name="nameEdit" 
                label="name"
            />
            <x-forms.input name="addressEdit" 
                label="address"
            />
            <x-forms.input name="linkAddressEdit" 
                label="link address"
                help="link location google map"
            />

            <x-modal.footer buttonName="Edit"/>
        </form>
    </x-modal>

    @push('extra-script')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('location-event.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'link_address', name: 'link_address' },
                    { data: 'user', name: 'user.name' },
                    { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editLocationEvent').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditLocationEvent").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#nameEdit").val(button.data('name'));
                $("#addressEdit").val(button.data('address'));
                $("#linkAddressEdit").val(button.data('link_address'));
            });
        });
    </script>
    @endpush
</x-panel.app>